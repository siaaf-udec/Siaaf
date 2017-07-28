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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

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
        return view('acadspace.registroSolicitud');
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

    public function listarSolicitud()
    {
        $solicitudes = Solicitud::all();
        $solicitudes = Solicitud::paginate(10);
       // return view('usuario.mostrarUsuario', compact('usuarios'));
       /* $estado=0;
        $sol = Solicitud::where('SOL_estado',$estado)->get();*/
        return view('acadspace.mostrarSolicitudes', compact('solicitudes'));
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

            $empleado = Solicitud::find($id);
            $empleado->SOL_estado = 1;
            $empleado->save();
            return back()->with('success','La solicitud fue aprobada correctamente');

        //return view('humtalent.empleado.editarEmpleado', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $empleado = Solicitud::find($id);
        $empleado->SOL_estado = 2;
        $empleado->save();
        return back()->with('success','La solicitud fue rechazada correctamente');
        //return view('humtalent.empleado.editarEmpleado', compact('empleado'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

}