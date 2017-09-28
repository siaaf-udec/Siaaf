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
use App\Container\Users\Src\Interfaces\UserInterface;
use App\Container\Acadspace\src\Solicitud;
use App\Container\Acadspace\src\solSoftware;
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
    {
        //Retorno los softwares disponibles a la vista
      /*  $soft = new solSoftware();
        $software = $soft->pluck('nombre_soft','id');
        return view('acadspace.Solicitudes.registroSolicitud', compact('software'));*/
        return view('acadspace.Solicitudes.solicitudGrupal');
    }

    public function create(Request $request){
        /*  $soft = new solSoftware();
          $software = $soft->pluck('nombre_soft','id');
          return view('acadspace.Solicitudes.registroSolicitudPracLibre', compact('software'));*/
        if($request->ajax() && $request->isMethod('GET')){
            //   $roles =  $this->roleRepository->index([]);
            /* return view('users.content-ajax.ajax-create-user', [
                 'roles' => $roles
             ]);*/
            return view('acadspace.Solicitudes.registroSolicitudGrupal');
        }else{
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
        if ($request['ID_Practica'] == 1) {

            $id = Auth::id();

            $model = new Solicitud();

            $model->SOL_guia_practica = $request['SOL_ReqGuia'];
            $model->SOL_software = $request['SOL_NombSoft'];
            $model->SOL_grupo = $request['SOL_grupo'];
            $model->SOL_cant_estudiantes = $request['SOL_cant_estudiantes'];
            $model->SOL_hora_inicio      = $request['SOL_hora_inicio'];
            $model->SOL_hora_fin         = $request['SOL_hora_fin'];
            $model->SOL_nucleo_tematico  = $request['SOL_nucleo_tematico'];
            $model->SOL_fecha_inicio     = $request['SOL_fecha_inicial'];
            $model->SOL_fecha_fin        = $request['SOL_fecha_inicial'];
            $model->SOL_id_docente = $id;
            $model->SOL_estado = 0;
            $model->id_practica = 2;

            $model->save();
            $notificacion = array(
                'message' => 'Solicitud registrada correctamente.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notificacion);

        } else {

            $diasSemana = '';
            foreach ($request['SOL_dias'] as $id) {

                $separador = ', ';
                if ($diasSemana == '') {
                    $diasSemana = $id;
                } else {
                    $diasSemana .= $separador . $id;
                }

            }

            Solicitud::create([
                'SOL_guia_practica' => $request['SOL_ReqGuia'],
                'SOL_software' => $request['SOL_NombSoft'],
                'SOL_grupo' => $request['SOL_grupo'],
                'SOL_cant_estudiantes' => $request['SOL_cant_estudiantes'],
                'SOL_dias' => $diasSemana,
                'SOL_hora_inicio' => $request['SOL_hora_inicio'],
                'SOL_hora_fin' => $request['SOL_hora_fin'],
                'SOL_estado' => 0,
                'SOL_nucleo_tematico' => $request['SOL_nucleo_tematico'],
                'SOL_fecha_inicio' => $request['SOL_fecha_inicial'],
                'SOL_fecha_fin' => $request['SOL_fecha_final'],
                'id_practica' => 1
            ]);
            $notificacion = array(
                'message' => 'Solicitud registrada correctamente.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notificacion);

        }
    }

    public function listarSolicitud(){
        $solicitudes = Solicitud::all();
        $solicitudes = Solicitud::paginate(10);
        return view('acadspace.Solicitudes.mostrarSolicitudes', compact('solicitudes'));
    }

    public function listarSolicitudLibre(){

        $solicitudes = Solicitud::all();
        $solicitudes = Solicitud::paginate(10);
        return view('acadspace.Solicitudes.mostrarSolicitudesLibre', compact('solicitudes'));
    }

    public function listarSolicitudAprobada(){
        $id = Auth::id();

        $solicitudes = Solicitud::all();
        $solicitudes = Solicitud::paginate(10);


        return view('acadspace.Solicitudes.solicitudesAprobadas', compact('solicitudes','id'));
    }

    public function estadoSolicitudesRealizadas(){
        $id = Auth::id();

        $solicitudes = Solicitud::all();
        /*$solicitudes = Solicitud::paginate(10);

        $SoftwareSol = solSoftware::all();
        $SoftwareSol = solSoftware::paginate(10);*/


        return view('acadspace.solicitudes.mostrarEstadoSolicitud', compact('solicitudes','SoftwareSol','id'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

    }


    public function edit($id){

        //Cambio el estado de la solicitud a 1 - aprobada
        $empleado = Solicitud::find($id);
        $empleado->SOL_estado = 1;
        $empleado->save();
        return back()->with('success','La solicitud fue aprobada correctamente');


    }
    public function aprobarSolicitud(Request $request){

        //Cambio el estado de la solicitud a 1 - aprobada y asigno la sala
        $solicitud = Solicitud::find($request['id_solicitud']);
        $solicitud->SOL_estado = 1;
        $solicitud->id_sala = $request['sala_asignada'];
        $solicitud->save();

        $notificacion = array(
            'message' => 'Solicitud aprobada y asignada correctamente.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notificacion);

    }

    public function agregarAnotacion(Request $request){

        $model = new comentariosSolicitud();
        //Cambio el estado de la solicitud a 2 - en estudio
        $solicitud = Solicitud::find($request['id_solicitud']);
        $solicitud->SOL_estado = 2;
        $solicitud->save();
        //Guardo la anotacion en la tabla comentario
        $model->COM_comentario = $request['txt_anotacion'];
        $model->FK_COM_id_solicitud = $request['id_solicitud'];
        $model->save();

        $notificacion = array(
            'message' => 'Anotacion agregada correctamente.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notificacion);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
       /* $empleado = Solicitud::find($id);
        $empleado->SOL_estado = 2;
        $empleado->save();
        return back()->with('success','Solicitud registrada correctamente');*/


    }

    public function destroy($id)
    {

    }

    public function listarSolPrueba(){
        return view('acadspace.Solicitudes.solicitudesAprobadas');
    }

    public function data(Request $request)
    {
        //$users = Solicitud::all();
        //dd($users);

        if($request->ajax() && $request->isMethod('GET')){
            /*
             * Forma Incorrecta
             * $users = $this->userRepository->index([]);
             * $users = $this->userRepository->getModel()::with('roles')->get();
             * */
            $users = Solicitud::all();


            return DataTables::of($users)

                ->addColumn('estado', function ($users){
                    if($users->SOL_estado==1){
                        return "<span class='label label-sm label-success'>".'Aprobado'. "</span>";
                    }elseif ($users->SOL_estado==0){
                        return "<span class='label label-sm label-warning'>".'Pendiente'. "</span>";
                    }
                })
                ->rawColumns(['estado'])
                ->removeColumn('SOL_guia_practica')
                ->removeColumn('SOL_software')
                ->removeColumn('SOL_hora_inicio')
                ->removeColumn('SOL_hora_fin')
                ->removeColumn('SOL_fecha_inicio')
                ->removeColumn('SOL_fecha_fin')
                ->removeColumn('SOL_dias')
                ->removeColumn('created_at')
                ->removeColumn('updated_at')
                ->addIndexColumn()
                ->make(true);

        }else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }

    }

}