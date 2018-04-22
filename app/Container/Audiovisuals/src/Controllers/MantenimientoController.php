<?php
/**
 * Created by PhpStorm.
 * User: Jerson Gutierrez
 * Date: 21/04/2018
 * Time: 5:42 PM
 */

namespace App\Container\Audiovisuals\src\Controllers;

use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Container\Audiovisuals\src\Validaciones;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class MantenimientoController extends Controller
{

    /**
     * Funcion que muestra la gestion de mantenimientos en articulos
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response| \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function index(Request $request)
    {
        if ($request->isMethod('GET')) {

            return view('audiovisuals.articulo.mantenimientoArticulos');

        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

}