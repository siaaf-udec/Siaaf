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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Metodo para mostrar la vista
    public function index()
    {
      /*  $sala = new Aulas();
        $sala = $sala->pluck('SAL_nombre_sala','SAL_nombre_sala');
        return view('acadspace.Solicitudes.evaluacionSolicitudes', ['sala'=>$sala->toArray()]);*/
        return view('acadspace.Solicitudes.evaluacionSolicitudes');
    }

    public function cargarSalas(Request $request,$espacio){
        if($request->ajax()){
            $aula = Aulas::where('SAL_nombre_espacio','=',$espacio)
                ->get();
            return response()->json($aula);
        }
    }
    //Metodo para cargar la informacion del datatable (las solicitudes)
    public function data(Request $request, $espacio)
{

    if($request->ajax() && $request->isMethod('GET')){

        //Consulta usando 2 tablas
        $users = Solicitud::where('SOL_estado', '=', 0)
            ->where('SOL_espacio','=', $espacio)
            ->where('SOL_id_practica', '=', 2)
            /*->select(['PK_SOL_id_solicitud', 'SOL_nucleo_tematico',
            'SOL_cant_estudiantes', 'SOL_id_practica',  'tbl_solicitud.created_at', 'SOL_dias', 'users.name as name',
            'users.lastname as lastname', 'SOL_hora_inicio', 'SOL_hora_fin', 'SOL_software'])*/
            ->join('developer.users', 'tbl_solicitud.SOL_id_docente', '=', 'developer.users.id')
            ->get();
        return DataTables::of($users)
            ->addColumn('tipo_prac', function ($users){
                if($users->SOL_id_practica==1){
                    return "Libre";
                }elseif ($users->SOL_id_practica==2){
                    return "Grupal";
                }
            })
            ->addIndexColumn()
            ->make(true);

    }else{
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

}
    public function cargarDataLibre(Request $request, $espacio)
    {

        if($request->ajax() && $request->isMethod('GET')){

            //Consulta usando 2 tablas
            $users = Solicitud::where('SOL_estado', '=', 0)
                ->where('SOL_espacio','=', $espacio)
                ->where('SOL_id_practica', '=', 1)
                /*->select(['PK_SOL_id_solicitud', 'SOL_nucleo_tematico',
                'SOL_cant_estudiantes', 'SOL_id_practica',  'tbl_solicitud.created_at', 'SOL_dias', 'users.name as name',
                'users.lastname as lastname', 'SOL_hora_inicio', 'SOL_hora_fin', 'SOL_software'])*/
                ->join('developer.users', 'tbl_solicitud.SOL_id_docente', '=', 'developer.users.id')
                ->get();
            return DataTables::of($users)
                ->addColumn('tipo_prac', function ($users){
                    if($users->SOL_id_practica==1){
                        return "Libre";
                    }elseif ($users->SOL_id_practica==2){
                        return "Grupal";
                    }
                })
                ->addIndexColumn()
                ->make(true);

        }else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }

    }

    //Metodo para aprobar solicitud y asignar sala
    public function aprobarSolicitud(Request $request){

        if ($request->ajax() && $request->isMethod('POST')) {
          //  $request->get('id_solicitud');
            $solicitud = Solicitud::findOrFail($request['id_solicitud']);
            $solicitud->SOL_estado = 1;
            $solicitud->FK_SOL_id_sala = $request['FK_SOL_id_sala'];
            $solicitud->save();
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Solicitud aprobada y asignada correctamente.'
            );
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }

    }
    //Metodo para rechazar solicitud y agregar anotacion
    public function agregarAnotacion(Request $request){

        if ($request->ajax() && $request->isMethod('POST')) {
            //Agregar comentario a tbl_comentarios y reprobar solicitud
            $model = new comentariosSolicitud();
            //Cambio el estado de la solicitud a 2 - en estudio
            $solicitud = Solicitud::find($request['id_solicitud']);
            $solicitud->SOL_estado = 2;
            $solicitud->save();
            //Guardo la anotacion en la tabla comentario
            $model->COM_comentario = $request['anotacion'];
            $model->FK_COM_id_solicitud = $request['id_solicitud'];
            $model->save();

            return AjaxResponse::success(
                '¡Bien hecho!',
                'Anotacion agregada correctamente.'
            );

        } else {

            return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
            );

        }
    }
    public function finalizarProceso(Request $request){
        if ($request->ajax() && $request->isMethod('POST')) {
            //Cambio el estado de la solicitud a 3 - proceso finalizado
            $solicitud = Solicitud::find($request['id_solicitud']);
            $solicitud->SOL_estado = 3;
            $solicitud->save();

            return AjaxResponse::success(
                '¡Bien hecho!',
                'Proceso finalizado correctamente.'
            );

        } else {

            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );

        }
    }

}