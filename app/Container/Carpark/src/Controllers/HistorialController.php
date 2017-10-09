<?php

namespace App\Container\Carpark\src\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use App\Container\Carpark\src\Dependencias;
use App\Container\Carpark\src\Estados;
use App\Container\Carpark\src\Usuarios;
use App\Container\Carpark\src\Motos;
use App\Container\Carpark\src\Ingresos;
use App\Container\Carpark\src\Historiales;
use Illuminate\Support\Facades\Storage;
use Barryvdh\Snappy\Facades\SnappyPdf;
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function indexAjax (Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET'))
        {
            return view('carpark.historiales.ajaxTablaHistoriales');
        }
        else
        {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    
    /**
     * Función que muestra el formulario de filtrado de un reporte de historiales.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filtrarFecha (Request $request)//
    {
        if($request->ajax() && $request->isMethod('GET'))
        {
            return view('carpark.historiales.filtrarFecha');
        }
        else
        {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    
    /**
     * Función que muestra el formulario de filtrado de un reporte de historiales.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filtrarCodigo (Request $request)//
    {
        if($request->ajax() && $request->isMethod('GET'))
        {
            return view('carpark.historiales.filtrarCodigo');
        }
        else
        {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }    

    /**
     * Función que muestra el formulario de filtrado de un reporte de historiales.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filtrarPlaca (Request $request)//
    {
        if($request->ajax() && $request->isMethod('GET'))
        {
            return view('carpark.historiales.filtrarPlaca');
        }
        else
        {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
}
