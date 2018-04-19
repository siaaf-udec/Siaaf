<?php

namespace App\Container\Audiovisuals\Src\Controllers;

use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Container\Audiovisuals\src\Validaciones;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ValidacionController extends Controller
{
    /**
     * Funcion que muestra las preguntas de validacion para las solicitudes de prestamos y reservas
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response| \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function index(Request $request)
    {
        if ($request->isMethod('GET')) {
            $preguntas = Validaciones::select()
                ->orderBy('id')
                ->get();
            return view('audiovisuals.validacion.tablaValidaciones')
                ->with('dato',$preguntas);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Funcion que modifca el valor de las preguntas de la tabla de validaciones
     *
     * @param Request $request
     * @param Validaciones $task
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function edit(Request $request, Validaciones $task)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $task->VAL_PRE_Valor = $request['value'];
            $task->save();
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos modificados correc ,mtamente.'
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

}
