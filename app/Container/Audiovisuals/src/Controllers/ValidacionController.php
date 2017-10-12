<?php

namespace App\Container\Audiovisuals\Src\Controllers;

use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Container\Audiovisuals\src\Validaciones;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class ValidacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $preguntas = Validaciones::select()
            ->orderBy('id')
            ->get();
        return view('audiovisuals.validacion.tablaValidaciones')
            ->with('dato',$preguntas);
    }
    public function edit(Request $request, Validaciones $task)
    {
        //return redirect('/tasks');
        if ($request->ajax() && $request->isMethod('POST')) {
            $task->VAL_PRE_Valor = $request['value'];
            $task->save();
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos modificados correc ,mtamente.'
            );
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }

}
