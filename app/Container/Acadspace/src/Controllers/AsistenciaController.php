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
use App\Container\Acadspace\src\Asistencia;
use App\Container\Acadspace\src\Aulas;
use App\Container\Overall\Src\Facades\AjaxResponse;

class AsistenciaController extends Controller
{

    /**
     * Retorna la vista de control estudiante
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function asisEst()
    {
        return view('acadspace.controlEstudiante');
    }

    /**
     * Retorna la vista de control docente
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function asisDoc()
    {
        return view('acadspace.controlDocente');
    }

    /**
     * Recibe el parametro espacio y retorna un json con las aulas
     * disponibles de acuerdo al espacio
     * @param \Illuminate\Http\Request $request
     * @param varchar $espacio
     * @return \Illuminate\Http\JsonResponse|\App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function cargarSalasAsitencia(Request $request, $espacio)
    {
        if ($request->ajax()) {
            $aula = Aulas::where('SAL_nombre_espacio', '=', $espacio)
                ->get();
            return response()->json($aula);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }


    /**
     * Registra ingreso del estudiante
     * @param Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse | \Illuminate\Http\Response
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
                'Ingreso registrado correctamente.'
            );


        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );


    }


    /**
     * Registra ingreso del docente
     * @param Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse | \Illuminate\Http\Response
     */
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
                'Ingreso registrado correctamente.'
            );

        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }

}