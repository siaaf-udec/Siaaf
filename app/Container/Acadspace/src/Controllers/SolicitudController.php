<?php
/**
 * Created by PhpStorm.
 * User: Edwin Clavijo
 * Date: 19/06/2017
 * Time: 2:20 PM
 */

namespace App\Container\Acadspace\src\Controllers;

use App\Container\Acadspace\src\UserAcadSpace;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Acadspace\src\Solicitud;
use App\Container\Acadspace\src\Software;
use App\Container\Overall\Src\Facades\AjaxResponse;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

use App\Container\Acadspace\src\Formatos;


class SolicitudController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    { //Mostrar el datatable con las solicitudes realizadas por el docente
        return view('acadspace.Solicitudes.solicitudGrupal');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexajax()
    { //Mostrar el datatable con las solicitudes realizadas por el docente
        return view('acadspace.Solicitudes.solicitudGrupal-ajax');
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create(Request $request)
    { //vista para registrar una practica grupal
        if ($request->ajax() && $request->isMethod('GET')) {
            $soft = new software();
            $software = $soft->pluck('SOf_nombre_soft', 'SOf_nombre_soft');
            return view('acadspace.Solicitudes.registroSolicitudGrupal', ['software' => $software->toArray()]);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function createlib(Request $request)
    { //registro en BD practica libre
        if ($request->ajax() && $request->isMethod('GET')) {
            $soft = new software();
            $software = $soft->pluck('SOF_nombre_soft', 'SOf_nombre_soft');
            return view('acadspace.Solicitudes.registroSolicitudPracLibre',
                [
                    'software' => $software->toArray()
                ]);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );


    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function registroSolicitudGrupal(Request $request)
    { //registro en BD practicas
        if ($request->ajax() && $request->isMethod('POST')) {

            $id = Auth::id();
            //Comparo que el software no venga vacio y en ese caso guardo como "ninguno"
            if (empty($request['SOL_NombSoft'])) {
                $nombreSoftware = "Ninguno";
            } else {
                $nombreSoftware = $request['SOL_NombSoft'];
            }

            if ($request['ID_Practica'] == 1) {

                $model = new Solicitud();

                $model->SOL_guia_practica = $request['SOL_ReqGuia'];
                $model->SOL_software = $nombreSoftware;
                $model->SOL_grupo = $request['SOL_grupo'];
                $model->SOL_cant_estudiantes = $request['SOL_cant_estudiantes'];
                $model->SOL_hora_inicio = $request['SOL_hora_inicio'];
                $model->SOL_hora_fin = $request['SOL_hora_fin'];
                $model->SOL_nucleo_tematico = $request['SOL_nucleo_tematico'];
                $model->SOL_rango_fechas = $request['SOL_fecha_inicial'];
                $model->SOL_carrera = $request['SOL_programa'];
                $model->SOL_id_docente = $id;
                $model->SOL_estado = 0;
                $model->SOL_id_practica = 1;
                $model->SOL_espacio = $request['SOL_espacio'];

                $model->save();

                return AjaxResponse::success(
                    '¡Bien hecho!',
                    'Solicitud registrada correctamente.'
                );

            } else {
                $model = new Solicitud();

                $model->SOL_guia_practica = $request['SOL_ReqGuia'];
                $model->SOL_software = $nombreSoftware;
                $model->SOL_grupo = $request['SOL_grupo'];
                $model->SOL_cant_estudiantes = $request['SOL_cant_estudiantes'];
                $model->SOL_hora_inicio = $request['SOL_hora_inicio'];
                $model->SOL_hora_fin = $request['SOL_hora_fin'];
                $model->SOL_nucleo_tematico = $request['SOL_nucleo_tematico'];
                $model->SOL_dias = $request['SOL_dias'];
                $model->SOL_carrera = $request['SOL_programa'];
                $model->SOL_id_docente = $id;
                $model->SOL_estado = 0;
                $model->SOL_id_practica = 2;
                $model->SOL_espacio = $request['SOL_espacio'];
                $model->SOL_rango_fechas = $request['SOL_rango_fechas'];

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
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function data(Request $request)
    {

        if ($request->ajax() && $request->isMethod('GET')) {
            $solicitud = Solicitud::select('PK_SOL_id_solicitud', 'SOL_nucleo_tematico',
                'SOL_cant_estudiantes', 'SOL_id_practica', 'SOL_estado', 'created_at',
                'SOL_software', 'FK_SOL_id_sala')
                ->where('SOL_id_docente', '=', Auth::id())
                ->with(['coment' => function ($query) {
                    return $query->select('PK_COM_id_comentario', 'COM_comentario',
                        'FK_COM_id_solicitud');
                }])
                ->get();
            return DataTables::of($solicitud)
                ->addColumn('estado', function ($users) {
                    if ($users->SOL_estado == 1) {
                        return "<span class='label label-sm label-success'>" . 'Aprobado' . "</span>";
                    } elseif ($users->SOL_estado == 0) {
                        return "<span class='label label-sm label-warning'>" . 'Pendiente' . "</span>";
                    } elseif ($users->SOL_estado == 2) {
                        return "<span class='label label-sm label-danger'>" . 'Reprobado' . "</span>";
                    } elseif ($users->SOL_estado == 3) {
                        return "<span class='label label-sm label-default'>" . 'Finalizado' . "</span>";
                    }
                })
                ->addColumn('tipo_prac', function ($users) {
                    if ($users->SOL_id_practica == 1) {
                        return "Libre";
                    } elseif ($users->SOL_id_practica == 2) {
                        return "Grupal";
                    }
                })
                ->rawColumns(['tipo_prac'])
                ->rawColumns(['estado'])
                ->addIndexColumn()
                ->make(true);

        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );


    }

    public function alexis(Request $request)
    {
        $id = Solicitud::where('id_sala', '=', 201)->pluck('SOL_GRUPO');
        dd($id);
        return view('acadspace.Solicitudes.prueba');

    }

    public function controladorX(UserAcadSpace $model)
    {
        $solic = formatos::select(['PK_FAC_id_solicitud',
            'FAC_titulo_doc', 'created_at', 'FK_FAC_id_secretaria'])
            ->with(['user' => function ($query) {
                return $query->select('id', 'name', 'lastname');
            }])
            ->where('FAC_estado', '=', 0)
            ->get();
        dd($solic);
        $solic = formatos::select(['PK_FAC_id_solicitud',
            'FAC_titulo_doc', 'created_at', 'FK_FAC_id_secretaria'])
            ->with(['user' => function ($query) {
                return $query->select('id', 'name', 'lastname');
            }])
            ->where('FAC_estado', '=', 0)
            ->get();
        //dd($solic);


        $solicitud = Solicitud::select('PK_SOL_id_solicitud', 'SOL_nucleo_tematico',
            'SOL_cant_estudiantes', 'SOL_id_practica', 'SOL_estado',
            'FK_SOL_id_sala')
            ->where('SOL_id_docente', '=', 1)
            ->with(['coment' => function ($query) {
                return $query->select('PK_COM_id_comentario', 'COM_comentario', 'FK_COM_id_solicitud');
            }])
            ->get();
        dd($solicitud);


        $alex = Solicitud::select('PK_SOL_id_solicitud', 'SOL_id_docente', 'SOL_nucleo_tematico',
            'SOL_cant_estudiantes', 'SOL_id_practica', 'created_at', 'SOL_carrera', 'SOL_dias',
            'SOL_hora_inicio', 'SOL_hora_fin', 'SOL_software')
            ->with(['user' => function ($query) {
                return $query->select('id', 'name', 'lastname');
            }])
            ->where('FK_SOL_id_sala', '=', 202)
            ->where('SOL_estado', '=', 1)
            ->get();
        dd($alex);


        $prueba = Solicitud::with('user')
            ->where('FK_SOL_id_sala', '=', 201)
            ->where('SOL_estado', '=', 1)
            ->get();
        dd($prueba);


        return Datatables::of($users)->make(true);

    }

}