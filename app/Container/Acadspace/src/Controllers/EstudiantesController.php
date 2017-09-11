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
use App\Container\Acadspace\src\Estudiantes;
use App\Container\Acadspace\src\Solicitud;
use Illuminate\Support\Facades\DB;
use App\Container\Overall\Src\Facades\AjaxResponse;

class EstudiantesController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('acadspace.controlEstudiante');
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
        $data = $request->all();

        $code = $data['codigo'];
        $rest = substr($code, -8, -6);
        if($rest == '61' || $rest == '63' || $rest == '60' || $rest == '10' || $rest == '14' || $rest == '40') {

            $model = new Estudiantes();

            $model->id_carrera =$this->obtenerCarrera($code);
            $model->nombre = $data['nombre'];
            $model->codigo = $data['codigo'];
            $model->save();

            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos modificados correctamente.'
            );
        }
        else{
            return AjaxResponse::fail(
                '¡Codigo invalido!',
                'No se pudo completar tu solicitud.'
            );
        }



    }

    public function obtenerCarrera($codigo){

        $rest = substr($codigo, -8, -6); // devuelve "d"

            if($rest == '61'){
                $id_carr = 1;//Ing Sistemas
            }
            if($rest == '63'){
                $id_carr = 2;//Ing Ambiental
            }
            if($rest == '60'){
                $id_carr = 3;//Ing Agronomica
            }
            if($rest == '10'){
                $id_carr = 4;//Administracion
            }
            if($rest == '14'){
                $id_carr = 5;//Contaduria
            }
            if($rest == '40'){
                $id_carr = 6;//Piscologia
            }

        return $id_carr;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $model = Estudiantes::all();
        $sist = $this->obtCont($model, 1);
        $amb = $this->obtCont($model, 2);
        $agron = $this->obtCont($model, 3);
        $admi = $this->obtCont($model, 4);
        $cont = $this->obtCont($model, 5);
        $psic = $this->obtCont($model, 6);
        //$roles = DB::table('tbl_estudiantes')->select('*')->where('id_carrera','=','1')->get();
        //$cont = $roles->count;
        //return view('acadspace.Reportes.reportesEstudiantes', compact('sist', 'amb', 'agron', 'admi', 'cont', 'psic'));
        dd('Ingenieria de Sistemas: '. $sist,
            'Ingenieria Ambiental: '. $amb, 'Ingenieria Agronomica: '. $agron, 'Administracion: '. $admi, 'Contaduria: '. $cont,
            'Psicologia: '. $psic);
    }

    public function obtCont($model,$id)
    {
        $cont=0;
        foreach($model as $user)
        {
            if($user->id_carrera == $id) {
                $cont = $cont + 1;
            }
        }
        return $cont;
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
        $empleado->SOL_estado = 2;
        $empleado->save();
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