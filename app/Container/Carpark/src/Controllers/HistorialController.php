<?php

namespace App\Container\Carpark\src\Controllers;

use Illuminate\Http\Request;
use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Http\Controllers\Controller;
use App\Container\Carpark\src\Historiales;
use Yajra\DataTables\DataTables;

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
     * Función que consulta los historiales registrados y los envía al datatable correspondiente.
     *
     * @param  \Illuminate\Http\Request
     * @return \Yajra\DataTables\DataTables| \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function tablaHistoriales(Request $request){
        if ($request->ajax() && $request->isMethod('GET')) {            
            return Datatables::of(Historiales::all())
                    ->removeColumn('CH_CodigoMoto') 
                    
                    ->removeColumn('updated_at')                   
                    ->addIndexColumn()
                    ->make(true);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }

    /**
     * Función que muestra el formulario de filtrado de un reporte de historiales por fechas.
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
     * Función que muestra el formulario de filtrado de un reporte de historiales por código de usuario.
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
     * Función que muestra el formulario de filtrado de un reporte de historiales por placa de la moto.
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
