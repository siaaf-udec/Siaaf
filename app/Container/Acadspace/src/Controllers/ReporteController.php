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
use Barryvdh\Snappy\Facades\SnappyPdf;

class ReporteController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('acadspace.Reportes.reportesIndex');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changeForm($fech){
        //10-05-2101
        $aaaa = substr($fech, -4);
        $dd  = substr($fech, -7,-5);
        $mm = substr($fech, -10,-8);

        return $aaaa.'-'.$mm.'-'.$dd;
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $code = $data['date_range'];

        $f2 = substr($code, -10);
        $f1 = substr($code, -23, -13);

        $fech1=$this->changeForm($f1);
        $fech2=$this->changeForm($f2);

        $date = date("d/m/Y");
        $time = date("h:i A");

//        $estudiantes = Estudiantes::whereBetween('created_at', [$fech1, $fech2])->orWhere(['id_carrera','=',1])->get();

//        $total = count($estudiantes);
        $totSistGrup = 7;
        $totSistLib = 9;
        $totAmbGrup = 5;
        $totAmbLib = 10;
        $totAgroGrup = 8;
        $totAgroLib = 3;

        $totalTot = $totSistGrup+$totSistLib+$totAmbGrup+$totAmbLib+$totAgroGrup+$totAgroLib;
        $cont = 1;

        return view('acadspace.Reportes.ReportesEstudiantes',
            //compact('empleados', 'date', 'time', 'totalTot', 'cont')
            compact('totSistGrup','totSistLib','totAmbGrup','totAmbLib','totAgroGrup','totAgroLib', 'date', 'time', 'totalTot', 'cont')
        );


    }

    public function DownloadEstReporte()
    {
        $date = date("d/m/Y");
        $time = date("h:i A");
        /*$empleados = Persona::whereNotNull('created_at',null)
            ->orderBy('PRSN_Nombres', 'asc')
            ->get();
        $total = count($empleados);*/
        $totSistGrup = 7;
        $totSistLib = 9;
        $totAmbGrup = 5;
        $totAmbLib = 10;
        $totAgroGrup = 8;
        $totAgroLib = 3;

        $totalTot = $totSistGrup+$totSistLib+$totAmbGrup+$totAmbLib+$totAgroGrup+$totAgroLib;
        $cont = 1;
        return SnappyPdf::loadView('acadspace.Reportes.ReportesEstudiantes',
            compact('totSistGrup','totSistLib','totAmbGrup','totAmbLib','totAgroGrup','totAgroLib', 'date', 'time', 'totalTot', 'cont')
        )->download('ReporteContacto.pdf');
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

    public function reportes()
    {

        return view('acadspace.Reportes.reportesIndex');
    }

}