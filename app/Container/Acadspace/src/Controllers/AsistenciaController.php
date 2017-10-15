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
use App\Container\Acadspace\src\Asistencia;
use App\Container\Acadspace\src\Aulas;
use App\Container\Acadspace\src\Solicitud;
use Illuminate\Support\Facades\DB;
use App\Container\Overall\Src\Facades\AjaxResponse;

class AsistenciaController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function asisEst()
    {
        return view('acadspace.controlEstudiante');
    }

    public function asisDoc()
    {
        return view('acadspace.controlDocente');
    }

    public function cargarSalasAsitencia(Request $request, $espacio)
    {
        if ($request->ajax()) {
            $aula = Aulas::where('SAL_nombre_espacio', '=', $espacio)
                ->get();
            return response()->json($aula);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function regisAsistenciaEst(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            $model = new Asistencia();

            $model->ASIS_Id_Identificacion = $request['ASIS_Id_Identificacion'];
            $model->ASIS_Espacio_Academico = $request['ASIS_Espacio_Academico'];
            $model->ASIS_Espacio = $request['ASIS_Espacio'];
            $model->ASIS_Id_Carrera = $request['ASIS_Id_Carrera'];
            $model->ASIS_Tipo_Practica = 1;

            $model->save();
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Asistencia registrada correctamente.'
            );


        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }

    }


    public function regisAsistenciaDoc(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            $model = new Asistencia();

            $model->ASIS_Id_Identificacion = $request['ASIS_Id_Identificacion'];
            $model->ASIS_Espacio_Academico = $request['ASIS_Espacio_Academico'];
            $model->ASIS_Espacio = $request['ASIS_Espacio'];
            $model->ASIS_Id_Carrera = $request['ASIS_Id_Carrera'];
            $model->ASIS_Nombre_Materia = $request['ASIS_Nombre_Materia'];
            $model->ASIS_Cant_Estudiantes = $request['ASIS_Cant_Estudiantes'];
            $model->ASIS_Tipo_Practica = 2;

            $model->save();
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Asistencia registrada correctamente.'
            );

        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }

}