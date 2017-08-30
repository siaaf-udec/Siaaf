<?php
/**
 * Created by PhpStorm.
 * User: Edwin Clavijo
 * Date: 19/06/2017
 * Time: 2:20 PM
 */

namespace App\Container\Acadspace\src\Controllers;

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
        foreach ($request['SOL_dias'] as $id){
            $separador = '|';
            if($diasSemana == ''){
                $diasSemana = $id;
            }else{
                $diasSemana .= $separador.$id;
            }
        }
        //return "Aqui refirige";
        Solicitud::create([
 //         'PK_PRSN_Cedula'          => $request['PK_PRSN_Cedula' ],
            'SOL_guia_practica'    => $request['SOL_ReqGuia'],
            'SOL_software'         => $request['SOL_ReqSoft'],
            'SOL_grupo'            => $request['SOL_grupo'],
            'SOL_cant_estudiantes' => $request['SOL_cant_estudiantes'],
            'SOL_dias'             => $diasSemana,
            'SOL_hora_inicio'      => $request['SOL_hora_inicio'],
            'SOL_hora_fin'         => $request['SOL_hora_fin'],
            'SOL_estado'           => 0,
            'SOL_fechas'           => $request['fechas_Solicitadas'],
            'SOL_nucleo_tematico'  => $request['SOL_nucleo_tematico']
        ]);
        return back()->with('success','Solicitud registrada correctamente');

    }

    public function listarSolicitud(){
        $solicitudes = Solicitud::all();
        $solicitudes = Solicitud::paginate(10);
        return view('acadspace.mostrarSolicitudes', compact('solicitudes'));
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
        //return "en el show";
       // return view('humtalent.empleado.consultaEmpleado');
    }


    public function edit($id){
        $empleado = Solicitud::find($id);
        $empleado->SOL_estado = 1;
        $empleado->save();
        return back()->with('success','La solicitud fue aprobada correctamente');

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
    public function update(Request $request, $id)
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