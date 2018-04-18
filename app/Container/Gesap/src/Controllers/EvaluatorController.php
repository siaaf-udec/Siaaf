<?php

namespace App\Container\Gesap\src\Controllers;

use Illuminate\Http\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use Yajra\DataTables\DataTables;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Exception;
use Validator;
use Carbon\Carbon;


use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Container\Overall\Src\Facades\UploadFile;

use App\Container\Gesap\src\Anteproyecto;
use App\Container\Gesap\src\Radicacion;
use App\Container\Gesap\src\Encargados;
use App\Container\Gesap\src\Observaciones;
use App\Container\Gesap\src\CheckObservaciones;
use App\Container\Gesap\src\Respuesta;
use App\Container\Gesap\src\Proyecto;
use App\Container\Gesap\src\Documentos;
use App\Container\Gesap\src\Actividad;
use App\Container\Gesap\src\Conceptos;
use App\Container\Users\Src\User;

class EvaluatorController extends Controller
{

    private $path = 'gesap.Evaluador.';


    /*
     * Listado de proyectos asignados como jurado
     *
	 * @param  \Illuminate\Http\Request
     *
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function jury(Request $request)
    {
        if ($request->isMethod('GET')) {
            return view($this->path . 'juradoList');
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /*
     * Función de almacenamiento en la base de datos de observaciones de proyectos
     *
     * @param  \Illuminate\Http\Request 
     * 
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function storeObservations(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $jurado = Encargados::select('PK_NCRD_IdCargo')
                ->where('FK_TBL_Anteproyecto_Id', '=', $request->get('PK_anteproyecto'))
                ->where('FK_Developer_User_Id', '=', $request->get('user'))
                ->where(function ($query) {
                    $query->where('NCRD_Cargo', '=', 'Jurado 1');
                    $query->orwhere('NCRD_Cargo', '=', 'Jurado 2');
                })
                ->firstOrFail();

            $observacion = new Observaciones();
            $observacion->BVCS_Observacion = $request->get('observacion');
            $observacion->FK_TBL_Encargado_Id = $jurado->PK_NCRD_IdCargo;
            $observacion->save();

            $checkobservacion = new CheckObservaciones();
            $checkobservacion->FK_TBL_Observaciones_Id = $observacion->PK_BVCS_IdObservacion;
            $checkobservacion->save();
            $date = Carbon::now();
            $date = $date->format('his');

            if ($request->get('Min') != "Vacio" || $request->get('Requerimientos') != "Vacio") {
                $respuesta = new Respuesta();
                if ($request->get('Min') == "Vacio") {
                    $respuesta->RPST_RMin = "NO FILE";
                } else {
                    $nombre = $date . "_" . $request['Min']->getClientOriginalName();
                    $respuesta->RPST_RMin = $nombre;
                    \Storage::disk('local')->put($nombre, \File::get($request->file('Min')));
                }
                if ($request->get('Requerimientos') == "Vacio") {
                    $respuesta->RPST_Requerimientos = "NO FILE";
                } else {
                    $nombre = $date . "_" . $request['Requerimientos']->getClientOriginalName();
                    $respuesta->RPST_Requerimientos = $nombre;
                    \Storage::disk('local')->put($nombre, \File::get($request->file('Requerimientos')));
                }
                $respuesta->FK_TBL_Observaciones_Id = $observacion->PK_BVCS_IdObservacion;
                $respuesta->save();
            }

            return AjaxResponse::success(
                '¡Registro Exitoso!',
                'Observacion Guardada correctamente.'
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /*
     * Función de almacenamiento o actualizacion en la base de datos de conceptos
     *
     * @param  \Illuminate\Http\Request 
     * 
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function storeConcepts(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            //Busco el ID del Encargado(Usuario respecto al proyecto)
            $jurado = Encargados::select('PK_NCRD_IdCargo', 'NCRD_Cargo')
                ->where('FK_TBL_Anteproyecto_Id', '=', $request->get('PK_anteproyecto'))
                ->where('FK_Developer_User_Id', '=', $request->user()->id)
                ->where(function ($query) {
                    $query->where('NCRD_Cargo', '=', 'Jurado 1');
                    $query->orwhere('NCRD_Cargo', '=', 'Jurado 2');
                })
                ->firstOrFail();
            if ($jurado->NCRD_Cargo == "Jurado 1") {
                $other = "Jurado 2";
            } else {
                $other = "Jurado 1";
            }
            $jurado2 = Encargados::select('PK_NCRD_IdCargo', 'NCRD_Cargo')
                ->where('FK_TBL_Anteproyecto_Id', '=', $request->get('PK_anteproyecto'))
                ->where('NCRD_Cargo', '=', $other)
                ->firstOrFail();

            //Consulto si los jurados ya ha realizado un concepto anteriormente
            $encargado = Conceptos::select('PK_CNPT_Conceptos', 'CNPT_Concepto')
                ->where('FK_TBL_Encargado_Id', '=', $jurado->PK_NCRD_IdCargo)
                ->where('CNPT_Tipo', '=', 'Anteproyecto')
                ->first();

            $encargado2 = Conceptos::select('PK_CNPT_Conceptos', 'CNPT_Concepto')
                ->where('FK_TBL_Encargado_Id', '=', $jurado2->PK_NCRD_IdCargo)
                ->where('CNPT_Tipo', '=', 'Anteproyecto')
                ->first();

            $anteproyecto = Anteproyecto::findOrFail($request->get('PK_anteproyecto'));

            if ($encargado == null) {//Averiguo si se encontro un concepto previo
                //si no lo hay se crea el concepto nuevo de este jurado respecto al proyecto
                Conceptos::create([
                    'CNPT_Concepto' => $request->get('concepto'),
                    'CNPT_Tipo' => "Anteproyecto",
                    'FK_TBL_Encargado_Id' => $jurado->PK_NCRD_IdCargo
                ]);
                if ($encargado2 != null) {
                    if ($request->get('concepto') != $encargado2->CNPT_Concepto) {
                        $anteproyecto->NPRY_Estado = "PENDIENTE";
                        $anteproyecto->save();
                        return AjaxResponse::success(
                            '¡Registro exitoso!',
                            'Los conceptos entre jurados no estan deacuerdo.'
                        );
                    } else {
                        if ($request->get('concepto') == 1 && $encargado2->CNPT_Concepto == 1) {
                            $anteproyecto->NPRY_Estado = "APROBADO";
                        } else {
                            if ($request->get('concepto') == 2 && $encargado2->CNPT_Concepto == 2) {
                                $anteproyecto->NPRY_Estado = "APLAZADO";
                            } else {
                                if ($request->get('concepto') == 3) {
                                    $anteproyecto->NPRY_Estado = "RECHAZADO";
                                } else {
                                    $anteproyecto->NPRY_Estado = "COMPLETADO";
                                }
                            }
                        }
                    }
                    $anteproyecto->save();
                    return AjaxResponse::success(
                        '¡Actualizacion exitosa!',
                        'El concepto se ha actualizado correctamente.'
                    );
                }
                $anteproyecto->NPRY_Estado = "EN REVISION";
                $anteproyecto->save();

                return AjaxResponse::success(
                    '¡Registro exitoso!',
                    'El concepto fue registrado correctamente.'
                );
            } else {//Si existe ya un concepto se actualiza el mismo
                $encargado->CNPT_Concepto = $request->get('concepto');
                $encargado->save();
                if ($encargado2 != null) {
                    if ($request->get('concepto') != $encargado2->CNPT_Concepto) {
                        $anteproyecto->NPRY_Estado = "PENDIENTE";
                        $anteproyecto->save();
                        return AjaxResponse::success(
                            '¡Actualizacion Exitosa!',
                            'Los conceptos no estan deacuerdo.'
                        );
                    } else {
                        if ($request->get('concepto') == 1 && $encargado2->CNPT_Concepto == 1) {
                            $anteproyecto->NPRY_Estado = "APROBADO";
                        } else {
                            if ($request->get('concepto') == 2 && $encargado2->CNPT_Concepto == 2) {
                                $anteproyecto->NPRY_Estado = "APLAZADO";
                            } else {
                                if ($request->get('concepto') == 3) {
                                    $anteproyecto->NPRY_Estado = "RECHAZADO";
                                } else {
                                    $anteproyecto->NPRY_Estado = "COMPLETADO";
                                }
                            }
                        }
                    }
                    $anteproyecto->save();
                    return AjaxResponse::success(
                        '¡Actualizacion exitosa!',
                        'El concepto se ha actualizado correctamente.'
                    );
                }
            }
            $anteproyecto->NPRY_Estado = "EN REVISION";
            $anteproyecto->save();
            return AjaxResponse::success(
                '¡Actualizacion exitosa!',
                'El concepto se ha actualizado correctamente.'
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /*
     * Función de almacenamiento en la base de datos de actividades para el estudiante
     *
     * @param  \Illuminate\Http\Request 
     * 
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function storeActividad(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $actividad = new Actividad();
            $actividad->CTVD_Nombre = $request->get('nombre');
            $actividad->CTVD_Descripcion = $request->get('descripcion');
            $actividad->CTVD_Default = 0;
            $actividad->save();

            $idactividad = $actividad->PK_CTVD_IdActividad;

            $documentos = new Documentos();
            $documentos->FK_TBL_Proyecto_Id = $request->get('PK_proyecto');
            $documentos->FK_TBL_Actividad_Id = $idactividad;
            $documentos->save();
            return AjaxResponse::success(
                '¡Creacion Existosa!',
                'Nueva actividad creada correctamente.'
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Funcion de eliminacion de activides de la base de datos
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request
     *
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function destroyActivity($id, Request $request)
    {
        if ($request->ajax() && $request->isMethod('DELETE')) {

            $documento = Documentos::findOrFail($id);
            $actividad = Actividad::withTrashed()->findOrFail($documento->FK_TBL_Actividad_Id);
            $Ubicacion = "gesap/proyecto/" . $id;
            Storage::disk('local')->deleteDirectory($Ubicacion);
            $documento->delete();
            if ($actividad->CTVD_Default == 0) {
                $actividad->forceDelete();
            }
            return AjaxResponse::success(
                '¡Eliminacion Exitosa!',
                'Datos eliminados correctamente.'
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );


    }

    /*
     * Listado de proyectos y anteproyectos asignados como director
     *
	 * @param  \Illuminate\Http\Request
     *
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function director(Request $request)
    {
        if ($request->isMethod('GET')) {
            return view($this->path . 'directorList');
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /*
     * Listado de proyectos y anteproyectos asignados como director con vista AJAX
     *
     * @param  \Illuminate\Http\Request
     *
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function directorAjax(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return view($this->path . 'directorList-ajax');
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /*
     * Listado de observaciones de proyecto seleccionado
     * Envia el id del proyecto para realizar la consulta
     *
     * @param  int $id 
     * @param  \Illuminate\Http\Request 
     *
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function show($id, Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return view($this->path . 'showObservation', [
                'id' => $id
            ]);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }


    /*
     * Funcion de aprobacion de anteproyecto por un director cuando este en estado aprobado
     * Se crean unas actividades por defecto segun el proyecto aprobado
     *
     * @param  int $id 
     * @param  \Illuminate\Http\Request 
     *
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function approved($id, Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $proyecto = new Proyecto();
            $proyecto->FK_TBL_Anteproyecto_Id = $id;
            $proyecto->save();

            $actividades = Actividad::where('CTVD_Default', '=', 1)->get();
            for ($i = 0; $i < $actividades->count(); $i++) {
                $proyecto->documentos()->save(new Documentos(['FK_TBL_Actividad_Id' => $actividades[$i]->PK_CTVD_IdActividad]));
            }

            return AjaxResponse::success(
                '¡Activacion Exitosa!',
                'Proyecto activado correctamente.'
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );


    }

    /*
     * Funcion de cierre o terminacion de proyecto por un director,
     * ya evitando mas cambios de los demas datos
     *
     * @param  int $id 
     * @param  \Illuminate\Http\Request 
     *
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function closeProject($id, Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $proyecto = Proyecto::where('FK_TBL_Anteproyecto_Id', '=', $id)->first();
            $proyecto->PRYT_Estado = "TERMINADO";
            $proyecto->save();

            return AjaxResponse::success(
                '¡Bien hecho!',
                'Proyecto cerrado correctamente.'
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /*
    * Consulta de observaciones de proyecto especifico
    *
    * @param int $id
    * @param  \Illuminate\Http\Request 
    *
    * @return Yajra\DataTables\DataTables | \App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function observationsList($id, Request $request)
    {
        if ($request->isMethod('GET')) {
            $observaciones = Observaciones::
            with(['encargado' => function ($encargados) use ($id) {
                $encargados->where('FK_TBL_Anteproyecto_Id', '=', $id);
                $encargados->where(function ($query) {
                    $query->where('NCRD_Cargo', '=', 'Jurado 1');
                    $query->orwhere('NCRD_Cargo', '=', 'Jurado 2');
                });
            },
                'respuesta'])
                ->get();
            return Datatables::of($observaciones)
                ->removeColumn('FK_TBL_Encargado_Id')
                ->removeColumn('created_at')
                ->removeColumn('updated_at')
                ->addIndexColumn()->make(true);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /*
    * Consulta de proyectos con sus datos correspondientes asignados al usuario actual como director
    *
    * @param  \Illuminate\Http\Request 
    *
    * @return Yajra\DataTables\DataTables | \App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function directorList(Request $request)
    {
        if ($request->isMethod('GET')) {
            $anteproyectos = Encargados::select('FK_Developer_User_Id', 'FK_TBL_Anteproyecto_Id', 'PK_NCRD_IdCargo')
                ->where('NCRD_Cargo', '=', "Director")
                ->where('FK_Developer_user_Id', '=', $request->user()->id)
                ->with(['anteproyecto' => function ($proyecto) {
                    $proyecto->with(['radicacion',
                        'director',
                        'jurado1',
                        'jurado2',
                        'estudiante1',
                        'estudiante2',
                        'proyecto']);
                }])
                ->get();
            return Datatables::of($anteproyectos)
                ->removeColumn('FK_Developer_User_Id')
                ->removeColumn('FK_TBL_Anteproyecto_Id')
                ->removeColumn('PK_NCRD_IdCargo')
                ->addColumn('NPRY_Estado', function ($users) {
                    if (!strcmp($users->anteproyecto->NPRY_Estado, 'EN REVISION')) {
                        return "<span class='label label-sm label-warning'>"
                            . $users->anteproyecto->NPRY_Estado
                            . "</span>";
                    } else {
                        if (!strcmp($users->anteproyecto->NPRY_Estado, 'PENDIENTE')) {
                            return "<span class='label label-sm label-warning'>"
                                . $users->anteproyecto->NPRY_Estado
                                . "</span>";
                        } else {
                            if (!strcmp($users->anteproyecto->NPRY_Estado, 'APROBADO')) {
                                if ($users->anteproyecto->proyecto != null) {
                                    if (!strcmp($users->anteproyecto->proyecto->PRYT_Estado, 'EN CURSO')) {
                                        return "<span class='label label-sm label-warning'>"
                                            . $users->anteproyecto->proyecto->PRYT_Estado
                                            . "</span>";
                                    } else {
                                        if (!strcmp($users->anteproyecto->proyecto->PRYT_Estado, 'TERMINADO')) {
                                            return "<span class='label label-sm label-success'>"
                                                . $users->anteproyecto->proyecto->PRYT_Estado
                                                . "</span>";
                                        } else {
                                            return "<span class='label label-sm label-info'>"
                                                . $users->anteproyecto->proyecto->PRYT_Estado
                                                . "</span>";
                                        }
                                    }
                                } else {
                                    return "<span class='label label-sm label-success'>"
                                        . $users->anteproyecto->NPRY_Estado
                                        . "</span>";
                                }
                            } else {
                                if (!strcmp($users->anteproyecto->NPRY_Estado, 'APLAZADO')) {
                                    return "<span class='label label-sm label-danger'>"
                                        . $users->anteproyecto->NPRY_Estado
                                        . "</span>";
                                } else {
                                    if (!strcmp($users->anteproyecto->NPRY_Estado, 'RECHAZADO')) {
                                        return "<span class='label label-sm label-danger'>"
                                            . $users->anteproyecto->NPRY_Estado
                                            . "</span>";
                                    } else {
                                        if (!strcmp($users->anteproyecto->NPRY_Estado, 'COMPLETADO')) {
                                            return "<span class='label label-sm label-success'>"
                                                . $users->anteproyecto->NPRY_Estado
                                                . "</span>";
                                        } else {
                                            return "<span class='label label-sm label-info'>"
                                                . $users->anteproyecto->NPRY_Estado
                                                . "</span>";
                                        }
                                    }
                                }
                            }
                        }
                    }
                })
                ->addColumn('NPRY_Titulo', function ($title) {
                    $marca = "<!--corte-->";
                    $largo = 50;
                    $titulo = $title->anteproyecto->NPRY_Titulo;
                    if (strlen($titulo) > $largo) {
                        $titulo = wordwrap($title->anteproyecto->NPRY_Titulo, $largo, $marca);
                        $titulo = explode($marca, $titulo);
                        $texto1 = $titulo[0];
                        unset($titulo[0]);
                        $texto2 = implode(' ', $titulo);
                        return '<p><span class="texto-mostrado">'
                            . $texto1
                            . '<span class="puntos">... </span></span><span class="texto-ocultado" style="display:none">'
                            . $texto2
                            . '</span> <span class="boton_mas_info">Ver más</span></p>';
                    }
                    return '<p>' . $titulo . '</p>';
                })
                ->rawColumns(['NPRY_Estado', 'NPRY_Titulo'])
                ->addIndexColumn()->make(true);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /*
    * Consulta de proyectos con sus datos correspondientes asignados al usuario actual como jurado
    *
    * @param  \Illuminate\Http\Request 
    *
    * @return Yajra\DataTables\DataTables | \App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function juryList(Request $request)
    {
        if ($request->isMethod('GET')) {
            $anteproyectos = Encargados::where(function ($query) {
                $query->where('NCRD_Cargo', '=', "Jurado 1");
                $query->orwhere('NCRD_Cargo', '=', "Jurado 2");
            })
                ->where('FK_Developer_User_Id', '=', $request->user()->id)
                ->with(['anteproyecto' => function ($proyecto) {
                    $proyecto->with(['radicacion',
                        'director',
                        'jurado1',
                        'jurado2',
                        'estudiante1',
                        'estudiante2',
                        'proyecto',
                        'conceptoFinal']);
                }])
                ->get();
            return Datatables::of($anteproyectos)
                ->removeColumn('FK_Developer_User_Id')
                ->removeColumn('FK_TBL_Anteproyecto_Id')
                ->removeColumn('PK_NCRD_IdCargo')
                ->addColumn('NPRY_Estado', function ($users) {
                    if (!strcmp($users->anteproyecto->NPRY_Estado, 'EN REVISION')) {
                        return "<span class='label label-sm label-warning'>"
                            . $users->anteproyecto->NPRY_Estado . "</span>";
                    } else {
                        if (!strcmp($users->anteproyecto->NPRY_Estado, 'PENDIENTE')) {
                            return "<span class='label label-sm label-warning'>"
                                . $users->anteproyecto->NPRY_Estado . "</span>";
                        } else {
                            if (!strcmp($users->anteproyecto->NPRY_Estado, 'APROBADO')) {
                                if ($users->anteproyecto->proyecto != null) {
                                    if (!strcmp($users->anteproyecto->proyecto->PRYT_Estado, 'EN CURSO')) {
                                        return "<span class='label label-sm label-warning'>"
                                            . $users->anteproyecto->proyecto->PRYT_Estado . "</span>";
                                    } else {
                                        if (!strcmp($users->anteproyecto->proyecto->PRYT_Estado, 'TERMINADO')) {
                                            return "<span class='label label-sm label-success'>"
                                                . $users->anteproyecto->proyecto->PRYT_Estado . "</span>";
                                        } else {
                                            return "<span class='label label-sm label-info'>"
                                                . $users->anteproyecto->proyecto->PRYT_Estado . "</span>";
                                        }
                                    }
                                } else {
                                    return "<span class='label label-sm label-success'>"
                                        . $users->anteproyecto->NPRY_Estado . "</span>";
                                }
                            } else {
                                if (!strcmp($users->anteproyecto->NPRY_Estado, 'APLAZADO')) {
                                    return "<span class='label label-sm label-danger'>"
                                        . $users->anteproyecto->NPRY_Estado . "</span>";
                                } else {
                                    if (!strcmp($users->anteproyecto->NPRY_Estado, 'RECHAZADO')) {
                                        return "<span class='label label-sm label-danger'>"
                                            . $users->anteproyecto->NPRY_Estado . "</span>";
                                    } else {
                                        if (!strcmp($users->anteproyecto->NPRY_Estado, 'COMPLETADO')) {
                                            return "<span class='label label-sm label-success'>"
                                                . $users->anteproyecto->NPRY_Estado . "</span>";
                                        } else {
                                            return "<span class='label label-sm label-info'>"
                                                . $users->anteproyecto->NPRY_Estado . "</span>";
                                        }
                                    }
                                }
                            }
                        }
                    }
                })
                ->addColumn('NPRY_Titulo', function ($title) {
                    $marca = "<!--corte-->";
                    $largo = 50;
                    $titulo = $title->anteproyecto->NPRY_Titulo;
                    if (strlen($titulo) > $largo) {
                        $titulo = wordwrap($title->anteproyecto->NPRY_Titulo, $largo, $marca);
                        $titulo = explode($marca, $titulo);
                        $texto1 = $titulo[0];
                        unset($titulo[0]);
                        $texto2 = implode(' ', $titulo);
                        return '<p><span class="texto-mostrado">'
                            . $texto1
                            . '<span class="puntos">... </span></span><span class="texto-ocultado" style="display:none">'
                            . $texto2
                            . '</span> <span class="boton_mas_info">Ver más</span></p>';
                    }
                    return '<p>' . $titulo . '</p>';
                })
                ->rawColumns(['NPRY_Estado', 'NPRY_Titulo'])
                ->addIndexColumn()->make(true);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Permite descargar el documento correspondiente de una actividad segun el proyecto
     *
     *
     * @param  Id $actividad
     * @param  String $archivo
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function downloadActivity($actividad, $archivo, Request $request)
    {
        if ($request->isMethod('GET')) {
            try {
                $url = storage_path('app/gesap/proyecto/' . $actividad . '/' . $archivo);
                return response()->download($url);
            } catch (Exception $e) {
                return view($this->path . 'directorList');
            }
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Permite descargar los documentes correspondientes de los proyectos
     *
     * @param  String $archivo
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function downloadDocument($archivo, Request $request)
    {
        if ($request->isMethod('GET')) {
            try {
                $url = storage_path('app/' . $archivo);
                return response()->download($url);
            } catch (Exception $e) {
                return AjaxResponse::success(
                    'Ocurrió un problema',
                    'No existe el documento.'
                );
            }
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
}
