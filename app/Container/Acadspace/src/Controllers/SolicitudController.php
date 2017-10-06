<?php
/**
 * Created by PhpStorm.
 * User: Edwin Clavijo
 * Date: 19/06/2017
 * Time: 2:20 PM
 */

namespace App\Container\Acadspace\src\Controllers;

use App\Container\Acadspace\src\comentariosSolicitud;
use App\Container\Acadspace\src\UserAcadSpace;
use App\Container\Users\Src\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Users\Src\Interfaces\UserInterface;
use App\Container\Acadspace\src\Solicitud;
use App\Container\Acadspace\src\Software;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

use App\Notifications\HeaderSiaaf;

use Validator;
use Illuminate\Support\Facades\Storage;
use App\Container\Permissions\Src\Interfaces\ModuleInterface;
use App\Container\Permissions\Src\Interfaces\RoleInterface;
use App\Container\Overall\Src\Facades\UploadFile;

use App\Container\Users\Src\Country;

use App\Container\Overall\Src\Facades\AjaxResponse;
use Yajra\DataTables\DataTables;

class SolicitudController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { //Mostrar el datatable con las solicitudes realizadas por el docente
        return view('acadspace.Solicitudes.solicitudGrupal');
    }

    public function indexajax()
    { //Mostrar el datatable con las solicitudes realizadas por el docente
        return view('acadspace.Solicitudes.solicitudGrupal-ajax');
    }


    public function create(Request $request)
    { //vista para registrar una practica grupal
        if ($request->ajax() && $request->isMethod('GET')) {
            $soft = new software();
            $software = $soft->pluck('SOf_nombre_soft', 'SOf_nombre_soft');
            return view('acadspace.Solicitudes.registroSolicitudGrupal', ['software' => $software->toArray()]);
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {

    }

    public function createlib(Request $request)
    { //registro en BD practica libre
        if ($request->ajax() && $request->isMethod('GET')) {
            $soft = new software();
            $software = $soft->pluck('SOF_nombre_soft', 'PK_SOF_id');
            return view('acadspace.Solicitudes.registroSolicitudPracLibre', ['software' => $software->toArray()]);
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }

    }

    public function registroSolicitudGrupal(Request $request)
    { //registro en BD practica grupal
        if ($request->ajax() && $request->isMethod('POST')) {
            $id = Auth::id();

            //Comparo que el software no venga vacio y en ese caso guardo como "ninguno"
            if (empty($request['SOL_NombSoft'])) {
                $nombreSoftware = "Ninguno";
            } else {
                $nombreSoftware = $request['SOL_NombSoft'];
            }

            if ($request['ID_Practica'] === 1) {

                $model = new Solicitud();


                $model->SOL_guia_practica = $request['SOL_ReqGuia'];
                $model->SOL_software = $nombreSoftware;
                $model->SOL_grupo = $request['SOL_grupo'];
                $model->SOL_cant_estudiantes = $request['SOL_cant_estudiantes'];
                $model->SOL_hora_inicio = $request['SOL_hora_inicio'];
                $model->SOL_hora_fin = $request['SOL_hora_fin'];
                $model->SOL_nucleo_tematico = $request['SOL_nucleo_tematico'];
                $model->SOL_fecha_inicio = $request['SOL_fecha_inicial'];
                $model->SOL_fecha_fin = $request['SOL_fecha_inicial'];
                $model->SOL_programa = $request['SOL_programa'];
                $model->SOL_id_docente = $id;
                $model->SOL_estado = 0;
                $model->SOL_id_practica = 1;


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
                $model->SOL_fecha_inicio = $request['SOL_fecha_inicial'];
                $model->SOL_fecha_fin = $request['SOL_fecha_inicial'];
                $model->SOL_dias = $request['SOL_dias'];
                $model->SOL_carrera = $request['SOL_programa'];
                $model->SOL_id_docente = $id;
                $model->SOL_estado = 0;
                $model->SOL_id_practica = 2;
                $model->SOL_espacio = $request['SOL_espacio'];

                $model->save();
                return AjaxResponse::success(
                    '¡Bien hecho!',
                    'Solicitud registrada correctamente.'
                );
            }
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }



    public function data(Request $request)
    {

        if ($request->ajax() && $request->isMethod('GET')) {
            //  $users = Solicitud::all();
            //Consulta usando 2 tablas
            $users = Solicitud::select(['PK_SOL_id_solicitud', 'SOL_nucleo_tematico', 'SOL_cant_estudiantes',
                'SOL_id_practica', 'FK_SOL_id_sala', 'tbl_solicitud.created_at', 'tbl_comentariosolicitud.COM_comentario as comentario',
                'SOL_estado', 'SOL_software'])
                ->leftjoin('tbl_comentariosolicitud', 'tbl_solicitud.PK_SOL_id_solicitud', '=', 'tbl_comentariosolicitud.FK_COM_id_solicitud')
                ->get();

            return DataTables::of($users)
                ->addColumn('estado', function ($users) {
                    if ($users->SOL_estado == 1) {
                        return "<span class='label label-sm label-success'>" . 'Aprobado' . "</span>";
                    } elseif ($users->SOL_estado == 0) {
                        return "<span class='label label-sm label-warning'>" . 'Pendiente' . "</span>";
                    } elseif ($users->SOL_estado == 2) {
                        return "<span class='label label-sm label-danger'>" . 'Reprobado' . "</span>";
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

        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }

    }

    public function alexis(Request $request)
    {
        $id = Solicitud::where('id_sala', '=', 201)->pluck('SOL_GRUPO');
        dd($id);
        return view('acadspace.Solicitudes.prueba');

    }

    public function controladorX()
    {
        $soft = software::all();
        dd($soft);
        /* $user = UserAcadSpace::find(1)->user()->create([
             'name' => 'miguel',
         ]);
         dd($user);*/
        $users = Solicitud::select(['PK_SOL_id_solicitud', 'SOL_guia_practica', 'SOL_software', 'tbl_solicitud.created_at', 'tbl_solicitud.updated_at', 'tbl_comentariosolicitud.COM_comentario as comentario'])
            ->leftjoin('tbl_comentariosolicitud', 'tbl_solicitud.PK_SOL_id_solicitud', '=', 'tbl_comentariosolicitud.FK_COM_id_solicitud')
            ->get();


        return Datatables::of($users)->make(true);
        /*   $comentarios = comentariosSolicitud::all()
           ->join('tbl_solicitud', 'tbl_solicitud.PK_SOL_id_solicitud', '=', 'tbl_comentariosolicitud.FK_COM_id_solicitud')
           ->select('tbl_solicitud.SOL_nucleo_tematico', 'tbl_comentariosolicitud.COM_comentario')
                ->get();
           dd($comentarios);*/
    }

}