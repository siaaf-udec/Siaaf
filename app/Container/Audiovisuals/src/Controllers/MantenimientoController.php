<?php
/**
 * Created by PhpStorm.
 * User: Jerson Gutierrez
 * Date: 21/04/2018
 * Time: 5:42 PM
 */

namespace App\Container\Audiovisuals\src\Controllers;

use App\Container\Audiovisuals\src\Solicitudes;
use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Container\Audiovisuals\src\Validaciones;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;


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

    /**
     * Funcion que muestra todas las solicitudes de mantenimiento de articulos registrados por medio de una petición ajax.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View|\App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function gestionMantenimientoAjax(Request $request){
        if($request->ajax() && $request->isMethod('GET')) {
            return view('audiovisuals.articulo.contenidoAjax.gestionMantenimientoAjax');
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Función que consulta los articulos registrados y los envía al datatable correspondiente.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function dataTableMantenimientos(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $articulos = Solicitudes::  //consulta_articulos.consulta_tipoArticulo.TPART_Nombre
            with(['consultaArticulos' => function($query){
                return $query->select('id','FK_ART_Tipo_id','ART_Descripcion','ART_Codigo')
                    ->with(['consultaTipoArticulo'=>function($query){
                        return $query->select(
                            'id','TPART_Nombre', 'TPART_HorasMantenimiento');
                    }
                    ]);
            }
            ])->get();
            //dd($articulos);
            $articulos = $articulos->groupBy('PRT_FK_Articulos_id');
            $cont =0;
            $sumador=0;
            $array2 = array();
            foreach ($articulos as $b) {
                $tiempo = Solicitudes::where('PRT_FK_Articulos_id','=',$b[0]['PRT_FK_Articulos_id'])
                    ->get();
                $horas=0;
                $sumador=0;
                foreach ($tiempo as $time) {
                    $inicio = new Carbon();
                    $inicio = Carbon::parse($time['PRT_Fecha_Inicio']);
                    $fin = new Carbon();
                    $fin = Carbon::parse($time['PRT_Fecha_Fin']);
                    $sumador = $sumador + ($inicio->diffInHours($fin));

                }
                $array = array_add($b[0], 'horasUso', $sumador);
                array_push($array2,$array);
                //dd($array2);
            }
            return DataTables::of($array2)
                ->removeColumn('created_at')
                ->removeColumn('updated_at')
                ->addIndexColumn()
                ->make(true);
            //dd($array2);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar la solicitud.'
        );
    }

}