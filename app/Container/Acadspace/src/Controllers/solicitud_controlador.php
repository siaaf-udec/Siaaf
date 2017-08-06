<?php
namespace App\Container\Acadspace\src\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Users\Src\Interfaces\UserInterface;
use App\Container\Acadspace\src\Solicitud;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class solicitud_controlador extends Controller
{
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
        return view('acadspace.solicitudes_espacio.registro_solicitud');
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
        $fechas = $request['SOL_fechas_solicitadas'];
        echo $fechas;
        foreach ($request['SOL_dias'] as $id){
            $separador = '|';
            if($diasSemana == ''){
                $diasSemana = $id;
            }else{
                $diasSemana .= $separador.$id;
            }
        }
        Solicitud::create([
            'SOL_guia_practica'    => $request['SOL_ReqGuia'],
            'SOL_software'         => $request['SOL_ReqSoft'],
            'SOL_nombre_software'  => $request['SOL_NombSoft'],
            'SOL_versions'         => $request['SOL_VersSoft'],
            'SOL_grupo'            => $request['SOL_grupo'],
            'SOL_cant_estudiantes' => $request['SOL_cant_estudiantes'],
            'SOL_dias'             => $diasSemana,
            'SOL_hora_inicio'      => $request['SOL_hora_inicio'],
            'SOL_hora_fin'         => $request['SOL_hora_fin'],
            'SOL_estado'           => 0,
            'SOL_fechas'           => $request['SOL_fechas_solicitadas'],
            'SOL_nucleo_tematico'  => $request['SOL_nucleo_tematico']
             ]);

        $notification=array(
            'message'=>'La información del empleado fue almacenada correctamente.',
            'alert-type'=>'success'
        );
       // return back()->with($notification);

    }

    public function listarSolicitud()
    {

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


    }

    public function destroy($id)
    {

    }

}