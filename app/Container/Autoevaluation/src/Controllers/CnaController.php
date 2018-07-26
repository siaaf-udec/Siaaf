<?php

namespace App\Container\Autoevaluation\src\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Overall\Src\Facades\AjaxResponse;

class CnaController extends Controller
{
    /**
     * Funcion para mostrar la vista lectorqr
     * @param Request $request
     * @return \Illuminate\View\View | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function index(Request $request)
    {

        if ($request->isMethod('GET')) {
                return view('autoevaluation.CNA.cna');
            }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }


}