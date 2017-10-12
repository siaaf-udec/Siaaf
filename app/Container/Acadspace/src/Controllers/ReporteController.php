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
use App\Container\Acadspace\src\Docentes;
use App\Container\Acadspace\src\Solicitud;
use App\Container\Acadspace\src\Aulas;
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

    public function repEst()
    {
        return view('acadspace.Reportes.reportesEst');
    }


    public function cargarSalasReportes(Request $request, $espacio)
    {
        if ($request->ajax()) {
            $aula = Aulas::where('SAL_nombre_espacio', '=', $espacio)
                ->get();
            return response()->json($aula);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function changeForm($fech)
    {
        //10-05-2101
        $aaaa = substr($fech, -4);
        $dd = substr($fech, -7, -5);
        $mm = substr($fech, -10, -8);

        return $aaaa . '-' . $mm . '-' . $dd;
    }


    public function obtenerTotalEstLab($fech1, $fech2, $id_Lab, $id_carr, $id_tipPrac)
    {
        //10-05-2101
        $estudiantes = Estudiantes::whereBetween('created_at', [$fech1, $fech2])
            ->where('EST_id_carrera', '=', $id_carr)
            ->where('EST_tipo_practica', '=', $id_tipPrac)
            ->where('EST_espacio', '=', $id_Lab)
            ->get();

        $total = count($estudiantes);
        return $total;
    }

    public function cargarRepEst(Request $request)
    {
        $data = $request->all();
        $code = $data['date_range'];
        $lab = $request['SOL_laboratorios'];

        $f2 = substr($code, -10);
        $f1 = substr($code, -23, -13);

        $fech1 = $this->changeForm($f1);
        $fech2 = $this->changeForm($f2);

        $date = date("d/m/Y");
        $time = date("h:i A");


        $totSistemasLibre = $this->obtenerTotalEstLab($fech1, $fech2, $lab, 1, 1);
        $totSistemasGrup = $this->obtenerTotalEstLab($fech1, $fech2, $lab, 1, 2);
        $totAmbientalLibre = $this->obtenerTotalEstLab($fech1, $fech2, $lab, 2, 1);
        $totAmbientalGrup = $this->obtenerTotalEstLab($fech1, $fech2, $lab, 2, 2);
        $totAgronomicaLibre = $this->obtenerTotalEstLab($fech1, $fech2, $lab, 3, 1);
        $totAgronomicaGrup = $this->obtenerTotalEstLab($fech1, $fech2, $lab, 3, 2);
        $totAdminLibre = $this->obtenerTotalEstLab($fech1, $fech2, $lab, 4, 1);
        $totAdminGrup = $this->obtenerTotalEstLab($fech1, $fech2, $lab, 4, 2);
        $totContaduriaLibre = $this->obtenerTotalEstLab($fech1, $fech2, $lab, 5, 1);
        $totContaduriaGrup = $this->obtenerTotalEstLab($fech1, $fech2, $lab, 5, 2);
        $totPiscologiaLibre = $this->obtenerTotalEstLab($fech1, $fech2, $lab, 6, 1);
        $totPiscologiaaGrup = $this->obtenerTotalEstLab($fech1, $fech2, $lab, 6, 2);


        $totalTot = $totSistemasLibre + $totSistemasGrup + $totAmbientalLibre + $totAmbientalGrup
            + $totAgronomicaLibre + $totAgronomicaGrup + $totAdminLibre + $totAdminGrup + $totContaduriaLibre
            + $totContaduriaGrup + $totPiscologiaLibre + $totPiscologiaaGrup;

        $cont = 1;
        return view('acadspace.Reportes.ReportesEstudiantes',
            compact('totSistemasLibre', 'totSistemasGrup',
                'totAmbientalLibre', 'totAmbientalGrup',
                'totAgronomicaLibre', 'totAgronomicaGrup',
                'totAdminLibre', 'totAdminGrup',
                'totContaduriaLibre', 'totContaduriaGrup',
                'totPiscologiaLibre', 'totPiscologiaaGrup',
                'totalTot', 'cont', 'date', 'time', 'fech1', 'fech2', 'lab', 'code')
        );


    }


    public function obtenerCarrera($codigo)
    {

        $rest = substr($codigo, -8, -6); // devuelve "d"

        if ($rest == '61') {
            $id_carr = 1;//Ing Sistemas
        }
        if ($rest == '63') {
            $id_carr = 2;//Ing Ambiental
        }
        if ($rest == '60') {
            $id_carr = 3;//Ing Agronomica
        }
        if ($rest == '10') {
            $id_carr = 4;//Administracion
        }
        if ($rest == '14') {
            $id_carr = 5;//Contaduria
        }
        if ($rest == '40') {
            $id_carr = 6;//Piscologia
        }

        return $id_carr;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */


    public function reporDocente(Request $request)
    {
        $data = $request->all();

        $fecha = $data['date_range_doc'];
        $lab = $request['SOL_laboratorios_doc'];
        $aula = $request['aulas'];

        $f2 = substr($fecha, -10);
        $f1 = substr($fecha, -23, -13);

        $fech1 = $this->changeForm($f1);//Cambia el formato de la fecha
        $fech2 = $this->changeForm($f2);

        $date = date("d/m/Y");//Fecha actual para adjuntar en el reporte
        $time = date("h:i A");

        $docentes = Docentes::whereBetween('created_at', [$fech1, $fech2])
        ->where('DOC_sala', '=', $aula)
        ->orderBy('created_at', 'asc')
        ->get();

        $totalTot = count($docentes);

        $cont = 1;
        return view('acadspace.Reportes.ReportesDocentes',
            compact('docentes', 'cont', 'date', 'time', 'fech1', 'fech2', 'lab', 'aula', 'totalTot', 'fecha')
        );


    }


    public function obtCont($model, $id)
    {
        $cont = 0;
        foreach ($model as $user) {
            if ($user->id_carrera == $id) {
                $cont = $cont + 1;
            }
        }
        return $cont;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }


}