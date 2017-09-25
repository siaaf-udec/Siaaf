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
use App\Container\Acadspace\src\calendarioSalones;
use Illuminate\Support\Facades\DB;
use App\Container\Overall\Src\Facades\AjaxResponse;

class CalendarioController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('acadspace.gestionhorarios.calendarioaulas');
    }
    public function cargaEventos()
    {

        $data = array();
        $id = calendarioSalones::all()->pluck('PK_CAL_id');
        $titulo = calendarioSalones::all()->pluck('CAL_titulo');
        $color = calendarioSalones::all()->pluck('CAL_color');
        $todoeldia = calendarioSalones::all()->pluck('allday');
        $fecha_inicial = calendarioSalones::all()->pluck('CAL_fecha_ini');
        $fecha_final = calendarioSalones::all()->pluck('CAL_fecha_fin');
        $count = count($id);

        for($i=0 ; $i<$count ; $i++){
            $data[$i] = array(
                "title" => $titulo[$i],
                "start" => $fecha_inicial[$i],
                "end"=>$fecha_final[$i],
                "allday" => $todoeldia[$i],
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
        //$todoeldia = $_POST['allday'];

        $evento = new calendarioSalones();

        $evento->CAL_titulo = $titulo;
        $evento->CAL_fecha_ini = $fecha_inicio;
        $evento->CAL_color=$color;
        $evento->CAL_todoeldia = true;

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
       // $evento->CAL_todoeldia=$allDay;
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


}