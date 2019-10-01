<?php

namespace App\Container\CalidadPcs\src\Controllers;

use App\Container\CalidadPcs\src\Costos;
use App\Container\CalidadPcs\src\Costos_Informacion;
use Illuminate\Http\Request;
use Illuminate\Http\File;

use App\Container\CalidadPcs\src\Procesos;
use App\Container\CalidadPcs\src\Proyectos;
use App\Container\CalidadPcs\src\Proceso_Proyecto;
use App\Container\CalidadPcs\src\Etapas;
use App\Container\CalidadPcs\src\Usuarios;
use App\Container\CalidadPcs\src\EquipoScrum;
use App\Container\CalidadPcs\src\ProcesoCronograma;
use App\Container\CalidadPcs\src\Proceso_Requerimientos;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class ProcesosController extends Controller
{
    //Etapas
    /**
     * Muestra todos los procesos registradas por medio de una petición ajax.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id_Proyecto
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function indexTablaAjaxEtapa(Request $request, $id)
    {
        $etapa1 = 0;
        $etapa2 = 0;
        $etapa3 = 0;
        $etapa4 = 0;
        $etapa5 = 0;
        $conteoEtapa = 0;
        $procesos = Proceso_Proyecto::where('FK_CPP_Id_Proyecto', $id);
        $aux = $procesos->count();
        if ($aux == 0) {
            $conteoEtapa = 1;
        } else {
            if ($aux <= 1) {
                $conteoEtapa = 2;
            } else {
                if ($aux <= 9) {
                    $conteoEtapa = 3;
                } else {
                    if ($aux <= 15) {
                        $conteoEtapa = 4;
                    } else {
                        if ($aux <= 24) {
                            $conteoEtapa = 5;
                        }
                    }
                }
            }
        }
        if ($aux <= 1) {
            $etapa1 = ($aux * 100) / 1;
        } else {
            $etapa1 = 100;
            $aux = $aux - 1;
            if ($aux < 8) {
                $etapa2 = ($aux * 100) / 8;
                $etapa2 = bcdiv($etapa2,'1',1);
            } else {
                $etapa2 = 100;
                $aux = $aux - 8;
                if ($aux < 6) {
                    $etapa3 = ($aux * 100) / 6;
                    $etapa3 = bcdiv($etapa3,'1',1);
                } else {
                    $etapa3 = 100;
                    $aux = $aux - 6;
                    if ($aux < 9) {
                        $etapa4 = ($aux * 100) / 9;
                        $etapa4 = bcdiv($etapa4,'1',1);
                    } else {
                        $etapa4 = 100;
                        $aux = $aux - 9;
                        if ($aux <= 1) {
                            $etapa5 = ($aux * 100) / 1;
                        }
                    }
                }
            }
        }
        $numProcesos = $procesos->count() + 1;
        $porcentajesEtapas = [$etapa1, $etapa2, $etapa3, $etapa4, $etapa5];
        if ($request->ajax() && $request->isMethod('GET')) {
            return view(
                'calidadpcs.etapas.tablaEtapasAjax',
                [
                    'idProyecto' => $id,
                    'numProcesos' => $numProcesos,
                    'porcentajes' => $porcentajesEtapas,
                    'conteoEtapa' => $conteoEtapa,
                ]
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Función que consulta los procesos registrados y los envía al datatable correspondiente.
     *
     * @param  \Illuminate\Http\Request
     * @return \Yajra\DataTables\DataTables | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function tablaEtapas(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return Datatables::of(Etapas::all())
                ->make(true);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    //Procesos

    /**
     * Muestra todos los procesos registrados.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('calidadpcs.procesos.tablaProcesos');
    }

    /**
     * Muestra todos los procesos registradas por medio de una petición ajax.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id_Proyecto
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function indexAjaxProcesos(Request $request, $idEtapa, $idProyecto)
    {
        $procesos = Proceso_Proyecto::where('FK_CPP_Id_Proyecto', $idProyecto);
        $numProcesos = $procesos->count();
        if ($numProcesos == null) {
            $numProcesos = 0;
        }
        $numProcesos = $procesos->count() + 1;
        $etapa = Etapas::where('PK_CE_Id_Etapa', $idEtapa)->first();
        $nomEtapa = $etapa->CE_Etapa;
        if ($request->ajax() && $request->isMethod('GET')) {
            return view(
                'calidadpcs.procesos.ajaxTablaProcesos',
                [
                    'idProyecto' => $idProyecto,
                    'idEtapa' => $idEtapa,
                    'numProcesos' => $numProcesos,
                    'nomEtapa' => $nomEtapa,
                ]
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Función que consulta los procesos registrados y los envía al datatable correspondiente.
     *
     * @param  \Illuminate\Http\Request
     * @return \Yajra\DataTables\DataTables | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function tablaProcesos(Request $request, $idEtapa)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

            $user2 = Procesos::where('FK_CP_Id_Etapa', $idEtapa);

            return Datatables::of($user2)
                ->addIndexColumn()
                ->removeColumn('CP_Tipo_Parseo')
                /*->addColumn('Etapa', function ($user2){
                    $perfil=Etapas::where('PK_CE_Id_Etapa', $user2->FK_CP_Id_Etapa)->first();
                    return $perfil['CE_Etapa'];
                })*/
                ->make(true);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }



    /**
     * Función que muestra el formulario de registro de un nuevo proyecto.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function registrarActividad(Request $request, $id, $idProyecto) //
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return view(
                'calidadpcs.procesos.formularios.cronograma.agregarActividad',
                [
                    'idProceso' => $id,
                    'idProyecto' => $idProyecto,
                ]
            );
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Función que muestra el formulario de registro de un nuevo proceso.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @param  int $idProyecto
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function formulario(Request $request, $id, $idProyecto)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

            $equipoScrum = EquipoScrum::where('FK_CE_Id_Proyecto', $idProyecto)->get();
            $infoProyecto = Proyectos::where('PK_CP_Id_Proyecto', $idProyecto)->get();
            if ($id == 1) {
                $existeProceso = Proceso_Proyecto::where('FK_CPP_Id_Proyecto', $idProyecto)->where('FK_CPP_Id_Proceso', $id)->get();
                if ($existeProceso == '[]') {
                    return view(
                        'calidadpcs.procesos.formularios.proceso1.actaInicio',
                        [
                            'idProceso' => $id,
                            'equipoScrum' => $equipoScrum,
                            'infoProyecto' => $infoProyecto,
                        ]
                    );
                } else {

                    $IdError = 422;
                    return AjaxResponse::success(
                        '¡Lo sentimos!',
                        'No se pudo completar la solicitud, ya se encuentra registrado ese proceso.',
                        $IdError
                    );
                }
            } elseif ($id == 2) {
                return view(
                    'calidadpcs.procesos.formularios.proceso2.documento',
                    [
                        'idProyecto' => $idProyecto,
                        'idProceso' => $id,
                        'equipoScrum' => $equipoScrum,
                    ]
                );
            } elseif ($id == 3) {
                $requerimientos = Proceso_Requerimientos::where('FK_CPR_Id_Proyecto', $idProyecto)->get()->pluck('CPR_Nombre_Requerimiento', 'PK_CPR_Id_Requerimientos')->toArray();
                $integrantesScrum = EquipoScrum::where('FK_CE_Id_Proyecto', $idProyecto)->where('FK_CE_Id_Rol', 5)->get()->pluck('CE_Nombre_Persona', 'PK_CE_Id_Equipo_Scrum')->toArray();
                return view(
                    'calidadpcs.procesos.formularios.proceso3.cronograma.cronogramaTabla',
                    [
                        'idProyecto' => $idProyecto,
                        'infoProyecto' => $infoProyecto,
                        'idProceso' => $id,
                        'requerimientos' => $requerimientos,
                        'integrantes' => $integrantesScrum,
                    ]
                );
            } elseif ($id == 4) {
                return view(
                    'calidadpcs.procesos.formularios.proceso4.costosTabla',
                    [
                        'idProyecto' => $idProyecto,
                        'idProceso' => $id
                    ]
                );
            } elseif ($id == 5) {
                $requerimientos = Proceso_Requerimientos::where('FK_CPR_Id_Proyecto', $idProyecto)->get()->pluck('CPR_Nombre_Requerimiento', 'PK_CPR_Id_Requerimientos')->toArray();
                $integrantesScrum = EquipoScrum::where('FK_CE_Id_Proyecto', $idProyecto)->where('FK_CE_Id_Rol', 5)->get()->pluck('CE_Nombre_Persona', 'PK_CE_Id_Equipo_Scrum')->toArray();
                return view(
                    'calidadpcs.procesos.formularios.proceso5.gestionCalidadTabla',
                    [
                        'idProyecto' => $idProyecto,
                        'infoProyecto' => $infoProyecto,
                        'idProceso' => $id,
                        'requerimientos' => $requerimientos,
                        'integrantes' => $integrantesScrum,
                    ]
                );
            } elseif ($id == 6) {
                return view(
                    'calidadpcs.procesos.formularios.proceso6.gestionRecursosHumanos',
                    [
                        'idProyecto' => $idProyecto,
                        'infoProyecto' => $infoProyecto,
                        'idProceso' => $id,
                    ]
                );
            } elseif ($id == 7) {
                return view(
                    'calidadpcs.procesos.formularios.proceso7.gestionComunicaciones',
                    [
                        'idProyecto' => $idProyecto,
                        'infoProyecto' => $infoProyecto,
                        'idProceso' => $id,
                    ]);
            } elseif ($id == 8) {
                return view(
                    'calidadpcs.procesos.formularios.proceso8.gestionRiesgos',
                    [
                        'idProyecto' => $idProyecto,
                        'infoProyecto' => $infoProyecto,
                        'idProceso' => $id,
                    ]);
            } elseif ($id == 9) {
                return view(
                    'calidadpcs.procesos.formularios.proceso9.gestionAdquisiciones',
                    [
                        'idProyecto' => $idProyecto,
                        'infoProyecto' => $infoProyecto,
                        'idProceso' => $id,
                    ]);
            } elseif ($id == 10) {
                return view(
                    'calidadpcs.procesos.formularios.proceso10.planDeDireccion',
                    [
                        'idProyecto' => $idProyecto,
                        'infoProyecto' => $infoProyecto,
                        'idProceso' => $id,
                    ]);
            } elseif ($id == 11) {
                return view(
                    'calidadpcs.procesos.formularios.proceso11.aseguramientoCalidad',
                    [
                        'idProyecto' => $idProyecto,
                        'infoProyecto' => $infoProyecto,
                        'idProceso' => $id,
                    ]);
            } elseif ($id == 12) {
                return view(
                    'calidadpcs.procesos.formularios.proceso12.dirigirEquipo',
                    [
                        'idProyecto' => $idProyecto,
                        'infoProyecto' => $infoProyecto,
                        'idProceso' => $id,
                    ]);
            } elseif ($id == 13) {
                return view(
                    'calidadpcs.procesos.formularios.proceso13.gestionarComunicaciones',
                    [
                        'idProyecto' => $idProyecto,
                        'infoProyecto' => $infoProyecto,
                        'idProceso' => $id,
                    ]);
            } elseif ($id == 14) {
                return view(
                    'calidadpcs.procesos.formularios.proceso14.EfectuarAdquisiciones',
                    [
                        'idProyecto' => $idProyecto,
                        'infoProyecto' => $infoProyecto,
                        'idProceso' => $id,
                    ]);
            } elseif ($id == 15) {
                return view(
                    'calidadpcs.procesos.formularios.proceso15.gestionarParticipacion',
                    [
                        'idProyecto' => $idProyecto,
                        'infoProyecto' => $infoProyecto,
                        'idProceso' => $id,
                    ]);
            } elseif ($id == 16) {
                return view(
                    'calidadpcs.procesos.formularios.proceso16.controlarTrabajo',
                    [
                        'idProyecto' => $idProyecto,
                        'infoProyecto' => $infoProyecto,
                        'idProceso' => $id,
                    ]);
            } elseif ($id == 17) {
                return view(
                    'calidadpcs.procesos.formularios.proceso17.controlarAlcance',
                    [
                        'idProyecto' => $idProyecto,
                        'infoProyecto' => $infoProyecto,
                        'idProceso' => $id,
                    ]);
            } elseif ($id == 18) {
                return view(
                    'calidadpcs.procesos.formularios.proceso18.controlarCronograma',
                    [
                        'idProyecto' => $idProyecto,
                        'infoProyecto' => $infoProyecto,
                        'idProceso' => $id,
                    ]);
            } elseif ($id == 19) {
                return view(
                    'calidadpcs.procesos.formularios.proceso19.controlarCostos',
                    [
                        'idProyecto' => $idProyecto,
                        'infoProyecto' => $infoProyecto,
                        'idProceso' => $id,
                    ]);
            } elseif ($id == 20) {
                return view(
                    'calidadpcs.procesos.formularios.proceso20.controlarCalidad',
                    [
                        'idProyecto' => $idProyecto,
                        'infoProyecto' => $infoProyecto,
                        'idProceso' => $id,
                    ]);
            } elseif ($id == 21) {
                return view(
                    'calidadpcs.procesos.formularios.proceso21.controlarComunicaciones',
                    [
                        'idProyecto' => $idProyecto,
                        'infoProyecto' => $infoProyecto,
                        'idProceso' => $id,
                    ]);
            } elseif ($id == 22) {
                return view(
                    'calidadpcs.procesos.formularios.proceso22.controlarRiesgos',
                    [
                        'idProyecto' => $idProyecto,
                        'infoProyecto' => $infoProyecto,
                        'idProceso' => $id,
                    ]);
            } elseif ($id == 23) {
                return view(
                    'calidadpcs.procesos.formularios.proceso23.controlarAdquisiciones',
                    [
                        'idProyecto' => $idProyecto,
                        'infoProyecto' => $infoProyecto,
                        'idProceso' => $id,
                    ]);
            } elseif ($id == 24) {
                return view(
                    'calidadpcs.procesos.formularios.proceso24.controlarInteresados',
                    [
                        'idProyecto' => $idProyecto,
                        'infoProyecto' => $infoProyecto,
                        'idProceso' => $id,
                    ]);
            } elseif ($id == 25) {
                return view(
                    'calidadpcs.procesos.formularios.proceso25.cerrarProyecto',
                    [
                        'idProyecto' => $idProyecto,
                        'infoProyecto' => $infoProyecto,
                        'idProceso' => $id,
                    ]);
            }
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Función que muestra el formulario de registro de un nuevo proceso.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @param  int $idProyecto
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function editarFormulario(Request $request, $id, $idProyecto)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

            $equipoScrum = EquipoScrum::where('FK_CE_Id_Proyecto', $idProyecto)->get();
            $infoProyecto = Proyectos::where('PK_CP_Id_Proyecto', $idProyecto)->get();

            if ($id == 1) {
                $existeProceso = Proceso_Proyecto::where('FK_CPP_Id_Proyecto', $idProyecto)->where('FK_CPP_Id_Proceso', $id)->get();
                $dataProceso = $existeProceso[0]['CPP_Info_Proceso'];
                $data = json_decode($dataProceso);
                if ($existeProceso == '[]') {
                    return AjaxResponse::success(
                        'Lo sentimos',
                        'No se pudo completar la solicitud, ya se encuentra registrado un proyecto con el mismo nombre.'
                    );
                } else {
                    return view(
                        'calidadpcs.procesos.formularios.proceso1.actaInicioEditar',
                        [
                            'idProceso' => $id,
                            'equipoScrum' => $equipoScrum,
                            'infoProyecto' => $infoProyecto,
                            'infoProceso' => $data,
                        ]
                    );
                }
            } elseif ($id == 2) {
                return view(
                    'calidadpcs.procesos.formularios.documento',
                    [
                        'idProceso' => $id,
                        'equipoScrum' => $equipoScrum,
                    ]
                );
            } elseif ($id == 3) {
                return view('calidadpcs.procesos.formularios.cronogramaTabla');
            }
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Función que almacena en la base de datos un nuevo procesp.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function storeProceso(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            //Tabla Proyectos

            $Fecha = Carbon::parse($request['Fecha_Inicio']);
            $Fecha_Final = $Fecha->addMonth($request['Duracion']);
            $proyecto = Proyectos::find($request['FK_CPP_Id_Proyecto']);
            $proyecto->fill([
                'CP_Fecha_Final' => $Fecha_Final,
            ]);
            $proyecto->save();
            //Tabla Proyecto Proceso
            $data = $request->only('Numero_acta', 'Fecha_Inicio', 'Tipo_Proyecto', 'Nombre_Proyecto', 'Duracion', 'Entidades', 'Objetivo_General', 'Objetivo_Especifico_1', 'Objetivo_Especifico_2', 'Objetivo_Especifico_3', 'Objetivo_Especifico_4', 'Objetivo_Especifico_5');
            Proceso_Proyecto::create([
                'CPP_Info_Proceso' => json_encode($data),
                'FK_CPP_Id_Proyecto' => $request['FK_CPP_Id_Proyecto'],
                'FK_CPP_Id_Proceso' => $request['FK_CPP_Id_Proceso'],
            ]);
            //Tabla requerimientos
            for ($i = 1; $i < 16; $i++) {
                if ($request['CPR_Nombre_Requerimiento_' . $i . ''] == '' || $request['CPR_Nombre_Requerimiento_' . $i . ''] == 'undefined') { } else {
                    Proceso_Requerimientos::create([
                        'CPR_Nombre_Requerimiento' => $request['CPR_Nombre_Requerimiento_' . $i . ''],
                        'FK_CPR_Id_Proyecto' => $request['FK_CPP_Id_Proyecto'],
                        'FK_CPR_Id_Proceso' => $request['FK_CPP_Id_Proceso'],
                    ]);
                }
            }
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos almacenados correctamente.'
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Función que consulta los procesos registrados y los envía al datatable correspondiente.
     *
     * @param  \Illuminate\Http\Request
     * @return \Yajra\DataTables\DataTables | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function tablaRequerimientos(Request $request, $idProyecto)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

            $requerimientos = Proceso_Requerimientos::where('FK_CPR_Id_Proyecto', $idProyecto);

            return Datatables::of($requerimientos)
                ->addIndexColumn()
                ->removeColumn('FK_CPR_Id_Proceso')
                ->make(true);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }



    // 
    // PROCESO #2 
    // 

    /**
     * Función que almacena en la base de datos un nuevo procesp.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function storeProceso2(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            //Tabla Proyecto Proceso
            //$data = $request->only('Numero_acta', 'Fecha_Inicio', 'Tipo_Proyecto', 'Nombre_Proyecto', 'Duracion', 'Entidades', 'Objetivo_General', 'Objetivo_Especifico_1', 'Objetivo_Especifico_2', 'Objetivo_Especifico_3', 'Objetivo_Especifico_4', 'Objetivo_Especifico_5');
            Proceso_Proyecto::create([
                'CPP_Info_Proceso' => $request['Alcance'],
                'FK_CPP_Id_Proyecto' => $request['FK_CPP_Id_Proyecto'],
                'FK_CPP_Id_Proceso' => $request['FK_CPP_Id_Proceso'],
            ]);

            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos almacenados correctamente. '
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Se realiza la eliminación de los registros de un vehículo.
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function destroyRequerimiento(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('DELETE')) {
            //$infoIngresos = Ingresos::where('CI_CodigoMoto','=',$id)->delete();
            Proceso_Requerimientos::destroy($id);
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos eliminados correctamente.'
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    // 
    //Proceso #3
    //

    /**
     * Función que consulta los procesos registrados y los envía al datatable correspondiente.
     *
     * @param  \Illuminate\Http\Request
     * @return \Yajra\DataTables\DataTables | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function tablaCronograma(Request $request, $idProyecto)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

            $cronograma = ProcesoCronograma::where('FK_CPP_Id_Proyecto', $idProyecto);
            return Datatables::of($cronograma)
                ->addIndexColumn()
                ->addColumn('RecursoNombre', function ($cronograma) {
                    $Nnombres = [];
                    $item = $cronograma->CPC_Recurso;
                    $nombres = explode(',', $item);
                    $perfil = EquipoScrum::whereIn('PK_CE_Id_Equipo_Scrum', $nombres)->get();
                    foreach ($perfil as $value) {
                        array_push($Nnombres, $value['CE_Nombre_Persona']);
                    }
                    $valores = implode(", ", $Nnombres);
                    return $valores;
                })
                ->addColumn('RequerimientoNombre', function ($cronograma) {
                    $Nnombres = [];
                    $item = $cronograma->CPC_Requerimiento;
                    $nombres = explode(',', $item);
                    $perfil = Proceso_Requerimientos::whereIn('PK_CPR_Id_Requerimientos', $nombres)->get();
                    foreach ($perfil as $value) {
                        array_push($Nnombres, $value['CPR_Nombre_Requerimiento']);
                    }
                    $valores = implode(", ", $Nnombres);
                    return $valores;
                })
                ->make(true);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Función que almacena en la base de datos un nuevo procesp.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function storeProceso3(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            ProcesoCronograma::create([
                'CPC_Nombre_Sprint' => $request['CPC_Nombre_Sprint'],
                'CPC_Requerimiento' => $request['CPC_Requerimiento'],
                'CPC_Duracion' => $request['CPC_Duracion'],
                'CPC_Recurso' => $request['CPC_Recurso'],
                'FK_CPP_Id_Proyecto' => $request['FK_CPP_Id_Proyecto'],
            ]);

            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos almacenados correctamente. '
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Función que almacena en la base de datos un nuevo procesp.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function storeProceso3_1(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            Proceso_Proyecto::create([
                'CPP_Info_Proceso' => "Proceso Gestion del tiempo, se creo correctamente",
                'FK_CPP_Id_Proyecto' => $request['FK_CPP_Id_Proyecto'],
                'FK_CPP_Id_Proceso' => $request['FK_CPP_Id_Proceso'],
            ]);
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos almacenados correctamente. '
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    // 
    // PROCESO #4
    // 

    /**
     * Función que consulta los procesos registrados y los envía al datatable correspondiente.
     *
     * @param  \Illuminate\Http\Request
     * @return \Yajra\DataTables\DataTables | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function tablaCostosInformacion(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return Datatables::of(Costos_Informacion::all())
                ->make(true);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

     /**
     * Función que almacena en la base de datos un nuevo procesp.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function storeProceso4(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            Costos::create([
                'CPC_Valor' => $request['valor'],
                'FK_CPC_Id_Formula' => $request['id_formula'],
                'FK_CPC_Id_Proyecto' => $request['FK_CPC_Id_Proyecto'],
            ]);
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos almacenados correctamente. '
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }


    // 
    // PROCESO #5
    // 

    /**
     * Función que consulta los procesos registrados y los envía al datatable correspondiente.
     *
     * @param  \Illuminate\Http\Request
     * @return \Yajra\DataTables\DataTables | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function tablaGestionCalidad(Request $request, $idProyecto)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $cronograma = ProcesoCronograma::where('FK_CPP_Id_Proyecto', $idProyecto);
            return Datatables::of($cronograma)
                ->addIndexColumn()
                ->addColumn('RecursoNombre', function ($cronograma) {
                    $Nnombres = [];
                    $item = $cronograma->CPC_Recurso;
                    $nombres = explode(',', $item);
                    $perfil = EquipoScrum::whereIn('PK_CE_Id_Equipo_Scrum', $nombres)->get();
                    foreach ($perfil as $value) {
                        array_push($Nnombres, $value['CE_Nombre_Persona']);
                    }
                    $valores = implode(", ", $Nnombres);
                    return $valores;
                })
                ->addColumn('RequerimientoNombre', function ($cronograma) {
                    $Nnombres = [];
                    $item = $cronograma->CPC_Requerimiento;
                    $nombres = explode(',', $item);
                    $perfil = Proceso_Requerimientos::whereIn('PK_CPR_Id_Requerimientos', $nombres)->get();
                    foreach ($perfil as $value) {
                        array_push($Nnombres, $value['CPR_Nombre_Requerimiento']);
                    }
                    $valores = implode(", ", $Nnombres);
                    return $valores;
                })
                ->make(true);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
}
