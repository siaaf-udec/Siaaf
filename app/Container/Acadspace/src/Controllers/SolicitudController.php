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

class SolicitudController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "Estoy en Index";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('acadspace.Solicitudes.registroSolicitud');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $diasSemana='';
        foreach ($request['SOL_dias'] as $id)
        {

            $separador = ', ';
            if($diasSemana == ''){
                $diasSemana = $id;
            }else{
                $diasSemana .= $separador.$id;
            }

        }

        Solicitud::create([
            'SOL_guia_practica'    => $request['SOL_ReqGuia'],
            'SOL_software'         => $request['SOL_NombSoft'],
            'SOL_grupo'            => $request['SOL_grupo'],
            'SOL_cant_estudiantes' => $request['SOL_cant_estudiantes'],
            'SOL_dias'             => $diasSemana,
            'SOL_hora_inicio'      => $request['SOL_hora_inicio'],
            'SOL_hora_fin'         => $request['SOL_hora_fin'],
            'SOL_estado'           => 0,
            'SOL_nucleo_tematico'  => $request['SOL_nucleo_tematico'],
            'SOL_fecha_inicio'     => $request['SOL_fecha_inicial'],
            'SOL_fecha_fin'        => $request['SOL_fecha_final']
        ]);
        return back()->with('success','Solicitud registrada correctamente');

    }

    public function listarSolicitud(){
        $solicitudes = Solicitud::all();
        $solicitudes = Solicitud::paginate(10);
        return view('acadspace.Solicitudes.mostrarSolicitudes', compact('solicitudes'));
    }

    public function listarSolicitudAprobada(){
        $id = Auth::id();

        $solicitudes = Solicitud::all();
        $solicitudes = Solicitud::paginate(10);

        $SoftwareSol = solSoftware::all();
        $SoftwareSol = solSoftware::paginate(10);


        return view('acadspace.solicitudesAprobadas', compact('solicitudes','SoftwareSol','id'));
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
        $empleado = Solicitud::find($id);
        $empleado->SOL_estado = 1;
        $empleado->save();
        return back()->with('success','La solicitud fue aprobada correctamente');

    }

    public function agregarAnotacion(Request $request){
       /* echo $request['txt_anotacion'];
        return ("hola"); */
        //if($request->ajax() && $request->isMethod('POST')){


                $model = new comentariosSolicitud();

                $model->COM_comentario = $request['txt_anotacion'];
                $model->FK_COM_id_solicitud = $request['invisible'];
                $model->save();
                return back()->with('success','Anotacion agregada correctamente');
             /*   return AjaxResponse::success(
                    '¡Bien hecho!',
                    'Solicitud registrada correctamente.'
                );

            }else{

        return AjaxResponse::fail(
        '¡Lo sentimos!',
        'No se pudo completar tu solicitud.'
        );

        }*/
    }

    public function editActPrac($id){
        $empleado = Solicitud::find($id);
        $empleado->SOL_estado = 2;
        $empleado->save();
        return back()->with('success','La solicitud fue aprobada correctamente');

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

}