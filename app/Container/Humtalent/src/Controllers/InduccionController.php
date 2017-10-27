<?php
/**
 * Created by PhpStorm.
 * User: Yeison Gomez
 * Date: 20/07/2017
 * Time: 9:57 PM
 */

namespace App\Container\Humtalent\src\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Humtalent\src\Persona;
use App\Container\Humtalent\src\Induction;
use Yajra\DataTables\DataTables;
use App\Container\Overall\Src\Facades\AjaxResponse;

class InduccionController extends Controller
{

    /**
     * Función que muestra el listado de empleados nuevos.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Yajra\DataTables\DataTables | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function listarEmpleadosNuevos(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return DataTables::of(Persona::where('PRSN_Estado_Persona', 'Nuevo')->get())
                ->addIndexColumn()
                ->make(true);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Función que muestra el paso de la induccion en la que se encuentra un empleado.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function index(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $procesoInduccion = Induction::where('FK_TBL_Persona_Cedula', $id)->get(['INDC_ProcesoInduccion']);
            if (count($procesoInduccion) > 0) {
                foreach ($procesoInduccion as $value) {
                    $proceso = $value->INDC_ProcesoInduccion;
                }
            } else {
                $proceso = 'Inicio';
            }
            return view('humtalent.inducciones.procesoInduccion', compact('id', 'proceso'));
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Función que muestra el listado de empleados nuevos por medio de una petición ajax.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function ajaxEmpleadosNuevos(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return view('humtalent.inducciones.ajaxTablaEmpleadosNuevos');
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function store(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $induccion = Induction::where('FK_TBL_Persona_Cedula', $request['FK_TBL_Persona_Cedula'])
                ->get(['PK_INDC_ID_Induccion']);
            if (count($induccion) > 0) {
                $induccion = Induction::find($induccion[0]['PK_INDC_ID_Induccion']);
                $induccion->INDC_ProcesoInduccion = $request[$request['numCheck']];
                $induccion->save();
                if (strcasecmp($request[$request['numCheck']], "Resultados de evaluación") == 0) {
                    $empleado = Persona::find($request['FK_TBL_Persona_Cedula']);
                    $empleado->PRSN_Estado_Persona = "Antiguo";
                    $empleado->save();
                }
            } else {
                Induction::create([
                    'INDC_ProcesoInduccion' => $request[$request['numCheck']],
                    'FK_TBL_Persona_Cedula' => $request['FK_TBL_Persona_Cedula'],
                ]);
            }
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos almacenados correctamente.'
            );
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }
}