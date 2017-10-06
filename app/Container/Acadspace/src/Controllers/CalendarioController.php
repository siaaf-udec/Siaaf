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
use App\Container\Acadspace\src\calendarioSalones;
use App\Container\Acadspace\src\Solicitud;
use App\Container\Acadspace\src\Aulas;
use App\Container\Overall\Src\Facades\AjaxResponse;
use Yajra\DataTables\DataTables;

class CalendarioController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sala = new Aulas();
        $sala = $sala->pluck('SAL_nombre_sala','SAL_nombre_sala');
        return view('acadspace.gestionhorarios.calendarioaulas', ['sala'=>$sala->toArray()]);
    }
    public function cargaEventos(Request $request)
    {
            $sala = $request['sala'];
            $data = array();
            $id = calendarioSalones::where('CAL_sala', '=', $sala)->pluck('PK_CAL_id');
            $titulo = calendarioSalones::where('CAL_sala', '=', $sala)->pluck('CAL_titulo');
            $color = calendarioSalones::where('CAL_sala', '=', $sala)->pluck('CAL_color');
            $fecha_inicial = calendarioSalones::where('CAL_sala', '=', $sala)->pluck('CAL_fecha_ini');
            $fecha_final = calendarioSalones::where('CAL_sala', '=', $sala)->pluck('CAL_fecha_fin');
            $count = count($id);

            for ($i = 0; $i < $count; $i++) {
                $data[$i] = array(
                    "title" => $titulo[$i],
                    "start" => $fecha_inicial[$i],
                    "end" => $fecha_final[$i],
                    "backgroundColor" => $color[$i],
                    "id" => $id[$i],

                );
            }
            json_encode($data);
            return $data;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $titulo = $_POST['title'];
        $fecha_inicio = $_POST['start'];
        $color = $_POST['background'];
        $sala = $_POST['salaSeleccionada'];
        $evento = new calendarioSalones();

        $evento->CAL_titulo = $titulo;
        $evento->CAL_fecha_ini = $fecha_inicio;
        $evento->CAL_color=$color;
        $evento->CAL_sala=$sala;

        $evento->save();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(){

        //Valores recibidos via ajax
        $id = $_POST['id'];
        $title = $_POST['title'];
        $start = $_POST['start'];
        $end = $_POST['end'];
        $allDay = $_POST['allday'];
        $back = $_POST['background'];

        $evento=calendarioSalones::find($id);
        if($end=='NULL'){
        }else{
            $evento->CAL_fecha_fin=$end;
        }
        $evento->CAL_fecha_ini=$start;
        $evento->CAL_color=$back;
        $evento->CAL_titulo=$title;
        //$evento->fechaFin=$end;

        $evento->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(){
        //Valor id recibidos via ajax
        $id = $_POST['id'];

        calendarioSalones::destroy($id);
    }

    public function data(Request $request, $sala)
    {

        if($request->ajax() && $request->isMethod('GET')){

            //Traigo unicamente las solicitudes aprobadas y muestro en el datatable
            $users = Solicitud::where('FK_SOL_id_sala', '=', $sala)
                ->where('SOL_estado', '=', 1);
            return DataTables::of($users)
                ->addColumn('tipo_prac', function ($users){
                    if($users->SOL_id_practica==1){
                        return "Libre";
                    }elseif ($users->SOL_id_practica==2){
                        return "Grupal";
                    }
                })
                ->rawColumns(['tipo_prac'])
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