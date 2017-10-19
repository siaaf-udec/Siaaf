<?php

namespace App\Container\Carpark\src\Controllers;

use Illuminate\Http\Request;
use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

class HistorialController extends Controller
{
    /**
     * Muestra la vista de inicio de la información de historial de personas y motos que han hecho uso del parqueadero.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('carpark.historiales.tablaHistoriales');
    }

    /**
     * Muestra la vista de inicio de la información de historial de personas y motos que han hecho uso del parqueadero por medio de una petición ajax.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function indexAjax(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return view('carpark.historiales.ajaxTablaHistoriales');
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }

    /**
     * Función que muestra el formulario de filtrado de un reporte de historiales.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function filtrarFecha(Request $request)//
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return view('carpark.historiales.filtrarFecha');
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }

    /**
     * Función que muestra el formulario de filtrado de un reporte de historiales.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function filtrarCodigo(Request $request)//
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return view('carpark.historiales.filtrarCodigo');
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }

    /**
     * Función que muestra el formulario de filtrado de un reporte de historiales.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function filtrarPlaca(Request $request)//
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return view('carpark.historiales.filtrarPlaca');
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }
}
