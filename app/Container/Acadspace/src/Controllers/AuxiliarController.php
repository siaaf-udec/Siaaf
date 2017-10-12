<?php
/**
 * Created by PhpStorm.
 * User: Edwin Clavijo
 * Date: 19/06/2017
 * Time: 2:20 PM
 */

namespace App\Container\Acadspace\src\Controllers;

use App\Container\Acadspace\src\comentariosSolicitud;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Acadspace\src\Solicitud;
use App\Container\Acadspace\src\Aulas;

use Validator;
use App\Container\Overall\Src\Facades\AjaxResponse;
use Yajra\DataTables\DataTables;

class AuxiliarController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('acadspace.Solicitudes.evaluacionSolicitudes');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexFinal()
    {
        return view('acadspace.Solicitudes.solicitudesFinalizadas');
    }


    /**
     * @param Request $request
     * @param $espacio
     * @return \Illuminate\Http\JsonResponse
     */
    public function cargarSalas(Request $request, $espacio)
    {
        if ($request->ajax()) {
            $aula = Aulas::where('SAL_nombre_espacio', '=', $espacio)
                ->get();
            return response()->json($aula);
        }
    }

    //Metodo para cargar la informacion del datatable (las solicitudes)

    /**
     * @param Request $request
     * @param $espacio
     * @return \Illuminate\Http\Response
     */
    public function data(Request $request, $espacio)
    {

        if ($request->ajax() && $request->isMethod('GET')) {
            $users = Solicitud::select('PK_SOL_id_solicitud', 'SOL_id_docente',
                'SOL_nucleo_tematico', 'SOL_cant_estudiantes', 'SOL_id_practica',
                'created_at', 'SOL_carrera', 'SOL_dias', 'SOL_hora_inicio',
                'SOL_hora_fin', 'SOL_guia_practica', 'SOL_software', 'SOL_rango_fechas')
                ->with(['user' => function ($query) {
                    return $query->select('id', 'name', 'lastname');
                }])
                ->where('SOL_espacio', '=', $espacio)
                ->where('SOL_id_practica', '=', 2)
                ->where('SOL_estado', '=', 0)
                ->get();
            return DataTables::of($users)
                ->addColumn('tipo_prac', function ($users) {
                    if ($users->SOL_id_practica == 1) {
                        return "Libre";
                    } elseif ($users->SOL_id_practica == 2) {
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
     * @param Request $request
     * @param $espacio
     * @return \Illuminate\Http\Response
     */
    public function cargarDataLibre(Request $request, $espacio)
    {

        if ($request->ajax() && $request->isMethod('GET')) {

            //Consulta usando 2 tablas
            $users = Solicitud::select('PK_SOL_id_solicitud', 'SOL_id_docente',
                'SOL_nucleo_tematico', 'SOL_cant_estudiantes', 'SOL_id_practica',
                'created_at', 'SOL_carrera', 'SOL_dias', 'SOL_hora_inicio',
                'SOL_hora_fin', 'SOL_guia_practica', 'SOL_software', 'SOL_rango_fechas')
                ->with(['user' => function ($query) {
                    return $query->select('id', 'name', 'lastname');
                }])
                ->where('SOL_espacio', '=', $espacio)
                ->where('SOL_id_practica', '=', 1)
                ->where('SOL_estado', '=', 0)
                ->get();
            return DataTables::of($users)
                ->addColumn('tipo_prac', function ($users) {
                    if ($users->SOL_id_practica == 1) {
                        return "Libre";
                    } elseif ($users->SOL_id_practica == 2) {
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

    //Metodo para aprobar solicitud y asignar sala

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function aprobarSolicitud(Request $request)
    {

        if ($request->ajax() && $request->isMethod('POST')) {
            //Aprobar solicitud
            $solicitud = Solicitud::findOrFail($request['id_solicitud']);
            $solicitud->SOL_estado = 1;
            $solicitud->FK_SOL_id_sala = $request['FK_SOL_id_sala'];
            $solicitud->save();

            $coment = new comentariosSolicitud();
            $coment->COM_comentario = "Ninguna";
            $coment->FK_COM_id_solicitud = $request['id_solicitud'];
            $coment->save();
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

    //Metodo para aprobar solicitud y asignar sala

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function aprobarSolicitudLibre(Request $request)
    {

        if ($request->ajax() && $request->isMethod('POST')) {
            //Aprobar solicitud
            $solicitud = Solicitud::findOrFail($request['id_solicitud_libre']);
            $solicitud->SOL_estado = 1;
            $solicitud->FK_SOL_id_sala = $request['FK_SOL_id_sala_libre'];
            $solicitud->save();

            $coment = new comentariosSolicitud();
            $coment->COM_comentario = "Ninguna";
            $coment->FK_COM_id_solicitud = $request['id_solicitud_libre'];
            $coment->save();
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

    //Metodo para rechazar solicitud y agregar anotacion

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function agregarAnotacion(Request $request)
    {

        if ($request->ajax() && $request->isMethod('POST')) {
            //Agregar comentario a tbl_comentarios y reprobar solicitud

            //Cambio el estado de la solicitud a 2 - en estudio
            $solicitud = Solicitud::find($request['id_solicitud']);
            $solicitud->SOL_estado = 2;
            $solicitud->save();
            //Guardo la anotacion en la tabla comentario
            $coment = new comentariosSolicitud();
            $coment->COM_comentario = $request['anotacion'];
            $coment->FK_COM_id_solicitud = $request['id_solicitud'];
            $coment->save();

            return AjaxResponse::success(
                '¡Bien hecho!',
                'Anotacion agregada correctamente.'
            );

        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );


    }

    //Metodo para rechazar solicitud y agregar anotacion

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function agregarAnotacionLibre(Request $request)
    {

        if ($request->ajax() && $request->isMethod('POST')) {
            //Agregar comentario a tbl_comentarios y reprobar solicitud

            //Cambio el estado de la solicitud a 2 - en estudio
            $solicitud = Solicitud::find($request['id_solicitud']);
            $solicitud->SOL_estado = 2;
            $solicitud->save();
            //Guardo la anotacion en la tabla comentario
            $coment = new comentariosSolicitud();
            $coment->COM_comentario = $request['anotacion'];
            $coment->FK_COM_id_solicitud = $request['id_solicitud'];
            $coment->save();

            return AjaxResponse::success(
                '¡Bien hecho!',
                'Anotacion agregada correctamente.'
            );

        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );


    }

    public function finalizarProceso(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            //Cambio el estado de la solicitud a 3 - proceso finalizado
            $solicitud = Solicitud::find($request['id_solicitud']);
            $solicitud->SOL_estado = 3;
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

    public function mostrarFinalizados(Request $request, $sala)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

            //Traigo unicamente las solicitudes aprobadas y muestro en el datatable
            $users = Solicitud::select('PK_SOL_id_solicitud', 'SOL_id_docente',
                'SOL_nucleo_tematico', 'SOL_id_practica', 'created_at',
                'SOL_dias', 'SOL_hora_inicio', 'SOL_hora_fin',
                'SOL_software', 'FK_SOL_id_sala')
                ->with(['user' => function ($query) {
                    return $query->select('id', 'name', 'lastname');
                }])
                ->where('SOL_espacio', '=', $sala)
                ->where('SOL_estado', '=', 3)
                ->get();
            return DataTables::of($users)
                ->addColumn('tipo_prac', function ($users) {
                    if ($users->SOL_id_practica == 1) {
                        return "Libre";
                    } elseif ($users->SOL_id_practica == 2) {
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

    public function destroy(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('DELETE')) {

            $solicitud = Solicitud::find($id);
            $solicitud->delete();
            $comentario = comentariosSolicitud::where('FK_COM_id_solicitud', '=', $id);
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