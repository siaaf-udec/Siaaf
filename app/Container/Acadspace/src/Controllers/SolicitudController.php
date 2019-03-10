<?php
/**
 * Created by PhpStorm.
 * User: Edwin Clavijo
 * Date: 19/06/2017
 * Time: 2:20 PM
 */

namespace App\Container\Acadspace\src\Controllers;


use App\Container\Users\src\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Overall\Src\Facades\AjaxResponse;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use App\Container\Acadspace\src\Solicitud;
use App\Container\Acadspace\src\Software;
use App\Container\Acadspace\src\Espacios;
use App\Container\Acadspace\src\Aulas;
use App\Container\Acadspace\src\Comentarios;
use App\Notifications\HeaderSiaaf;


class SolicitudController extends Controller
{


    /**
     * Mostrar el datatable con las solicitudes realizadas por el docente
     * @param Request $request
     * @return \Illuminate\View\View | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function mostrarSolicitudesDocente(Request $request)
    {
        if ($request->isMethod('GET')) {
            return view('acadspace.Solicitudes.solicitudGrupal');
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }


    /**
     * Mostrar el datatable con las solicitudes realizadas por el docente AJAX
     * @param Request $request
     * @return \Illuminate\View\View | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function mostrarSolicitudesDocenteAjax(Request $request)
    {
        if ($request->isMethod('GET')) {
            return view('acadspace.Solicitudes.solicitudGrupal-ajax');
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }


    /**
     * vista para crear una practica grupal
     * retorna los software disponibles del modelo Software
     * @param Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse |
     * \Illuminate\View\View
     */
    public function crearSolicitudGrupal(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $espa = new espacios();
            $espacios = $espa->pluck('ESP_Nombre_Espacio', 'PK_ESP_Id_Espacio');
            $soft = new software();
            $software = $soft->orderBy('PK_SOF_Id', 'desc')
                ->pluck('SOF_Nombre_Soft', 'PK_SOF_Id');
            return view('acadspace.Solicitudes.registroSolicitudGrupal',
                [
                    'software' => $software->toArray(),
                    'espacios' => $espacios->toArray()
                ]
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }


    /**
     * Vista para crear una solicitud libre
     * retorna los software disponibles del modelo Software
     * @param Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse |
     * \Illuminate\View\View
     */
    public function crearSolicitudLibre(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $espa = new espacios();
            $espacios = $espa->pluck('ESP_Nombre_Espacio', 'PK_ESP_Id_Espacio');
            $soft = new software();
            $software = $soft->orderBy('PK_SOF_Id', 'desc')
                ->pluck('SOF_Nombre_Soft', 'PK_SOF_Id');
            return view('acadspace.Solicitudes.registroSolicitudPracLibre',
                [
                    'software' => $software->toArray(),
                    'espacios' => $espacios->toArray()
                ]
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );


    }


    /**
     * Registro en BD de practicas libre y grupal,
     * se realiza la comparacion previa
     * retorna mensaje ajax
     * @param Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function registroSolicitud(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $id = Auth::id();
            $model = new Solicitud();
            $model->SOL_Guia_Practica = $request['SOL_ReqGuia'];
            $model->FK_SOL_Id_Software = $request['SOL_NombSoft'];
            $model->SOL_Grupo = $request['SOL_Grupo'];
            $model->SOL_Cant_Estudiantes = $request['SOL_Cant_Estudiantes'];
            $model->SOL_Hora_Inicio = $request['SOL_Hora_Inicio'];
            $model->SOL_Hora_Fin = $request['SOL_Hora_Fin'];
            $model->SOL_Nucleo_Tematico = $request['SOL_Nucleo_Tematico'];
            $model->SOL_Carrera = $request['SOL_programa'];
            $model->FK_SOL_Id_Docente = $id;
            $model->SOL_Estado = 0;
            $model->SOL_Espacio = $request['SOL_Espacio'];

            if ($request['ID_Practica'] == 1) {

                $model->SOL_fecha_inicial = $request['SOL_fecha_inicial'];
                $model->SOL_Id_Practica = 1;
                $model->save();

                return AjaxResponse::success(
                    '¡Bien hecho!',
                    'Solicitud registrada correctamente.'
                );

            } else {
                $model->SOL_Dias = $request['SOL_Dias'];
                $model->SOL_Id_Practica = 2;
                $model->SOL_Rango_Fechas = $request['SOL_Rango_Fechas'];
                $model->save();
                return AjaxResponse::success(
                    '¡Bien hecho!',
                    'Solicitud registrada correctamente.'
                );
            }
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }


    /**
     * Funcion cargar datatable con solicitudes registradas
     * por el docente con sesion activa
     * @param Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse | \Yajra\DataTables\
     */
    public function cargarTablaDoc(Request $request)
    {

        if ($request->ajax() && $request->isMethod('GET')) {
            $solicitud = Solicitud::select('PK_SOL_Id_Solicitud', 'SOL_Nucleo_Tematico',
                'SOL_Cant_Estudiantes', 'SOL_Id_Practica', 'SOL_Estado', 'created_at',
                'FK_SOL_Id_Software', 'FK_SOL_Id_Sala')
                ->where('FK_SOL_Id_Docente', '=', Auth::id())
                ->with(['coment' => function ($query) {
                    return $query->select('PK_COM_Id_Comentario', 'COM_Comentario',
                        'FK_COM_Id_Solicitud');
                }])
                ->with(['aula' => function ($query) {
                    return $query->select('PK_SAL_Id_Sala',
                        'SAL_Nombre_Sala');
                }])
                ->with(['software' => function ($query) {
                    return $query->select('PK_SOF_Id',
                        'SOF_Nombre_Soft');
                }])
                ->get();
            return DataTables::of($solicitud)
                ->addColumn('estado', function ($users) {
                    if ($users->SOL_Estado == 1) {
                        return "<span class='label label-sm label-success'>" . 'Aprobado' . "</span>";
                    } elseif ($users->SOL_Estado == 0) {
                        return "<span class='label label-sm label-warning'>" . 'Pendiente' . "</span>";
                    } elseif ($users->SOL_Estado == 2) {
                        return "<span class='label label-sm label-danger'>" . 'Reprobado' . "</span>";
                    } elseif ($users->SOL_Estado == 3) {
                        return "<span class='label label-sm label-default'>" . 'Finalizado' . "</span>";
                    }
                })
                ->addColumn('tipo_prac', function ($users) {
                    if ($users->SOL_Id_Practica == 1) {
                        return "Libre";
                    } elseif ($users->SOL_Id_Practica == 2) {
                        return "Grupal";
                    }
                })
                ->rawColumns(['tipo_prac'])
                ->rawColumns(['estado'])
                ->removeColumn('SOL_Estado')
                ->removeColumn('SOL_Id_Practica')
                ->removeColumn('updated_at')
                ->removeColumn('FK_SOL_Id_Software')
                ->removeColumn('FK_SOL_Id_Sala')
                ->addIndexColumn()
                ->make(true);

        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );


    }

    //Metodos relacionados con solicitud Auxiliar de apoyo

    /**
     * Mostrar el formulario con las solicitudes realizadas por el docente
     * para ser evaluadas por el auxiliar
     * @param Request $request
     * @return \Illuminate\View\View | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function mostrarSolicitudesAuxiliar(Request $request)
    {
        if ($request->isMethod('GET')) {
            $espa = new espacios();
            $espacios = $espa->pluck('ESP_Nombre_Espacio', 'PK_ESP_Id_Espacio');
            return view('acadspace.Solicitudes.evaluacionSolicitudes',
                [
                    'espacios' => $espacios->toArray()
                ]);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Mostrar el formulario con las solicitudes que ya han terminado su
     * proceso de aprobacion y asignacion
     * @param Request $request
     * @return \Illuminate\View\View | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function mostrarSolicitudesFinalizadas(Request $request)
    {
        if ($request->isMethod('GET')) {
            $espa = new espacios();
            $espacios = $espa->pluck('ESP_Nombre_Espacio', 'PK_ESP_Id_Espacio');
            return view('acadspace.Solicitudes.solicitudesFinalizadas',
                [
                    'espacios' => $espacios->toArray()
                ]);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Funcion para cargar salas de acuerdo al espacio academico
     * la info viene en la variable $espacio
     * y retorna un json con las aulas actualmente registradas
     * @param Request $request
     * @param $espacio
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function cargarSalas(Request $request, $espacio)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $aula = Aulas::where('FK_SAL_Id_Espacio', '=', $espacio)
                ->get();
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos recibidos correctamente.', $aula
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Mostrar el datatable con las solicitudes grupales realizadas por el docente
     * para ser evaluadas por el auxiliar
     * @param Request $request
     * @param $espacio
     * @return \App\Container\Overall\Src\Facades\AjaxResponse | \Yajra\DataTables\
     */
    public function cargarTablaSolGrupal(Request $request, $espacio)
    {

        if ($request->ajax() && $request->isMethod('GET')) {
            $users = Solicitud::select('PK_SOL_id_solicitud', 'FK_SOL_Id_Docente',
                'SOL_Nucleo_Tematico', 'SOL_Cant_Estudiantes', 'SOL_Id_Practica',
                'created_at', 'SOL_Carrera', 'SOL_Dias', 'SOL_Hora_Inicio',
                'SOL_Hora_Fin', 'SOL_Guia_Practica', 'FK_SOL_Id_Software', 'SOL_Rango_Fechas')
                ->with(['user' => function ($query) {
                    return $query->select('name', 'lastname');
                }])
                ->with(['software' => function ($query) {
                    return $query->select('PK_SOF_Id',
                        'SOF_Nombre_Soft');
                }])
                ->where('SOL_Espacio', '=', $espacio)
                ->where('SOL_Id_Practica', '=', 2)
                ->where('SOL_Estado', '=', 0)
                ->get();
            return DataTables::of($users)
                ->addColumn('tipo_prac', function ($users) {
                    if ($users->SOL_Id_Practica == 1) {
                        return "Libre";
                    } elseif ($users->SOL_Id_Practica == 2) {
                        return "Grupal";
                    }
                })
                ->addIndexColumn()
                ->make(true);

        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );


    }

    /**
     * Mostrar el datatable con las solicitudes libres realizadas por el docente
     * para ser evaluadas por el auxiliar
     * @param Request $request
     * @param $espacio
     * @return \App\Container\Overall\Src\Facades\AjaxResponse | \Yajra\DataTables\
     */
    public function cargarTablaSolLibre(Request $request, $espacio)
    {

        if ($request->ajax() && $request->isMethod('GET')) {

            //Consulta usando 2 tablas
            $users = Solicitud::select('PK_SOL_id_solicitud', 'FK_SOL_Id_Docente',
                'SOL_Nucleo_Tematico', 'SOL_Cant_Estudiantes', 'SOL_Id_Practica',
                'created_at', 'SOL_Carrera', 'SOL_Dias', 'SOL_Hora_Inicio',
                'SOL_Hora_Fin', 'SOL_Guia_Practica', 'FK_SOL_Id_Software', 'SOL_Fecha_Inicial')
                ->with(['user' => function ($query) {
                    return $query->select('name', 'lastname');
                }])
                ->with(['software' => function ($query) {
                    return $query->select('PK_SOF_Id',
                        'SOF_Nombre_Soft');
                }])
                ->where('SOL_Espacio', '=', $espacio)
                ->where('SOL_Id_Practica', '=', 1)
                ->where('SOL_Estado', '=', 0)
                ->get();
            return DataTables::of($users)
                ->addColumn('tipo_prac', function ($users) {
                    if ($users->SOL_Id_Practica == 1) {
                        return "Libre";
                    } elseif ($users->SOL_Id_Practica == 2) {
                        return "Grupal";
                    }
                })
                ->addIndexColumn()
                ->make(true);

        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );


    }

    /**
     * Funcion para aprobar solicitud retorna un mensaje ajax
     * y envia notificacion al usuario
     * @param Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function aprobarSolicitud(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            //Aprobar solicitud
            $solicitud = Solicitud::findOrFail($request['id_solicitud']);
            $solicitud->SOL_Estado = 1;
            $solicitud->FK_SOL_Id_Sala = $request['FK_SOL_Id_Sala'];
            $solicitud->save();

            $coment = new Comentarios();
            $coment->COM_Comentario = "Ninguna";
            $coment->FK_COM_Id_Solicitud = $request['id_solicitud'];
            $coment->save();


            $user = User::find($solicitud->FK_SOL_Id_Docente);
            $data = [
                'url' => url('espacios-academicos/solacad/indexDoc'),
                'description' => '¡Tiene una solicitud aprobada!',
                'image' => 'assets/layouts/layout2/img/search_icon_light.png'
            ];
            $user->notify(new HeaderSiaaf($data)); // se crea la notificación

            return AjaxResponse::success(
                '¡Bien hecho!',
                'Solicitud aprobada y asignada correctamente.'
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Funcion para reprobar solicitud y agregar anotacion retorna un mensaje ajax
     * @param Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function agregarAnotacion(Request $request)
    {

        if ($request->ajax() && $request->isMethod('POST')) {
            //Agregar comentario a tbl_comentarios y reprobar solicitud

            //Cambio el estado de la solicitud a 2 - en estudio
            $solicitud = Solicitud::find($request['id_solicitud']);
            $solicitud->SOL_Estado = 2;
            $solicitud->save();
            //Guardo la anotacion en la tabla comentario
            $coment = new Comentarios();
            $coment->COM_Comentario = $request['anotacion'];
            $coment->FK_COM_Id_Solicitud = $request['id_solicitud'];
            $coment->save();

            $user = User::find($solicitud->FK_SOL_Id_Docente);
            $data = [
                'url' => url('espacios-academicos/solacad/indexDoc'),
                'description' => '¡Tiene una solicitud rechazada!',
                'image' => 'assets/layouts/layout2/img/search_icon_light.png'
            ];
            $user->notify(new HeaderSiaaf($data)); // se crea la notificación

            return AjaxResponse::success(
                '¡Bien hecho!',
                'Anotación agregada correctamente.'
            );

        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }

    /**
     * Funcion para finalizar proceso solicitud
     * (es decir cuando ya ha sido asignada)
     * retorna un mensaje ajax
     * @param Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function finalizarProceso(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            //Cambio el estado de la solicitud a 3 - proceso finalizado
            $solicitud = Solicitud::find($request['id_solicitud']);
            $solicitud->SOL_Estado = 3;
            $solicitud->save();

            return AjaxResponse::success(
                '¡Bien hecho!',
                'Proceso finalizado correctamente.'
            );

        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );


    }

    /**
     *  Mostrar el datatable con las solicitudes finalizadas
     *  evaluadas por el auxiliar
     * @param Request $request
     * @param $sala
     * @return \App\Container\Overall\Src\Facades\AjaxResponse | \Yajra\DataTables\
     */
    public function mostrarFinalizados(Request $request, $sala)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

            //Traigo unicamente las solicitudes aprobadas y muestro en el datatable
            $users = Solicitud::select('PK_SOL_id_solicitud', 'FK_SOL_Id_Docente',
                'SOL_Nucleo_Tematico', 'SOL_Id_Practica', 'created_at',
                'SOL_Dias', 'SOL_Hora_Inicio', 'SOL_Hora_Fin',
                'FK_SOL_Id_Software', 'FK_SOL_Id_Sala', 'SOL_fecha_inicial')
                ->with(['user' => function ($query) {
                    return $query->select('name', 'lastname');
                }])
                ->with(['aula' => function ($query) {
                    return $query->select('PK_SAL_Id_Sala',
                        'SAL_Nombre_Sala');
                }])
                ->with(['software' => function ($query) {
                    return $query->select('PK_SOF_Id',
                        'SOF_Nombre_Soft');
                }])
                ->where('SOL_Espacio', '=', $sala)
                ->where('SOL_Estado', '=', 3)
                ->get();
            return DataTables::of($users)
                ->addColumn('tipo_prac', function ($users) {
                    if ($users->SOL_Id_Practica == 1) {
                        return "Libre";
                    } elseif ($users->SOL_Id_Practica == 2) {
                        return "Grupal";
                    }
                })
                ->rawColumns(['tipo_prac'])
                ->addIndexColumn()
                ->make(true);

        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }

    /**
     * Eliminar solicitudes unicamente permitido por el rol
     * Auxiliar de apoyo retorna respuesta ajax
     * @param Request $request
     * @param $id
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('DELETE')) {

            $solicitud = Solicitud::find($id);
            $solicitud->delete();
            $comentario = Comentarios::where('FK_COM_Id_Solicitud', '=', $id);
            $comentario->delete();
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Solicitud eliminada correctamente.'
            );

        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }


}