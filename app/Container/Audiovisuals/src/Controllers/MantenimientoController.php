<?php
/**
 * Created by PhpStorm.
 * User: Jerson Gutierrez
 * Date: 21/04/2018
 * Time: 5:42 PM
 */

namespace App\Container\Audiovisuals\src\Controllers;

use App\Container\Audiovisuals\src\Articulo;
use App\Container\Audiovisuals\src\MantenimientoArticulos;
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
                return $query->select('id','FK_ART_Tipo_id','ART_Descripcion','ART_Codigo','ART_Cantidad_Mantenimiento')
                    ->with(['consultaTipoArticulo'=>function($query){
                        return $query->select(
                            'id','TPART_Nombre', 'TPART_HorasMantenimiento');
                    }
                    ]);
            }
            ])->where('PRT_FK_Estado','=',7)->get();
            $articulos = $articulos->groupBy('PRT_FK_Articulos_id');
            $cont =0;
            $sumador=0;
            $array2 = array();
            foreach ($articulos as $b) {
                $tiempo = Solicitudes::
                where('PRT_FK_Articulos_id','=',$b[0]['PRT_FK_Articulos_id'])
                    ->where('PRT_FK_Estado','=',7)
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
            }
            return DataTables::of($array2)
                ->removeColumn('created_at')
                ->removeColumn('updated_at')
                ->addIndexColumn()
                ->make(true);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar la solicitud.'
        );
    }
    /**
     * Fucion que muestra la gestion de los kits por mdeio de una peticion ajax
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function registrarMantenimiento(Request $request){
        //registarar la sancion y cambiar de estado al articulo.
        if($request->ajax() && $request->isMethod('POST')) {
            MantenimientoArticulos::create([
                'TMT_Tipo_Articulo' => $request->get('TMT_Tipo_Articulo'),
                'TMT_FK_Id_Articulo' => $request->get('TMT_FK_Id_Articulo'),
                'TMT_Observacion_Realiza' => $request->get('TMT_Observacion_Realiza'),
                'FK_TMT_Tipo_Solicitud'=>6,//mantenimietno
                'FK_TMT_Estado_id'=>6//mantenimiento
            ]);
            Solicitudes::
                where('PRT_FK_Articulos_id','=',$request->get('TMT_FK_Id_Articulo'))
                ->update(['PRT_FK_Estado' => 6]);//mantenimiento
            return AjaxResponse::success(
                '¡Solicitud Mantenimiento!',
                'Registrada correctamente.'
            );

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
    public function dataTableMantenimientosSolicitados(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $mantenimineto = MantenimientoArticulos::with('consultarArticulo')->get();
            return Datatables::of($mantenimineto)
                ->removeColumn('created_at')
                ->removeColumn('updated_at')
                ->addColumn('Acciones', function ($manteni) {
                    if ($manteni->FK_TMT_Estado_id == 7) {
                        return "<span class='label label-sm label-success'>"
                            .'Finalizada'
                            . "</span>";
                    } else {
                        return "<span class='label label-sm label-warning'>"
                            .'Sin Verificar'
                            . "</span>";
                        //return '<a title="Finalizar Mantenimiento" href="javascript:;" class="btn btn-simple btn-success btn-icon create"><i class="glyphicon glyphicon-ok-circle"></i></a>';
                    }
                })
                ->addColumn('TMT_Observacion_FinalizaO', function ($manteni) {
                    if ($manteni->FK_TMT_Estado_id == 6) {
                        return "<span class='label label-sm label-warning'>"
                            .'Sin Respuesta'
                            . "</span>";
                    } else {
                        return $manteni->TMT_Observacion_Finaliza;
                    }
                })
                ->rawColumns(['Acciones','TMT_Observacion_FinalizaO'])
                ->removeColumn('created_at')
                ->removeColumn('updated_at')
                ->addIndexColumn()->make(true);

        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar la solicitud.'
        );
    }
    /**
     * Fucion que muestra la gestion de los kits por mdeio de una peticion ajax
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function finalizarMantenimiento(Request $request){
        if($request->ajax() && $request->isMethod('POST')) {
            MantenimientoArticulos::where('TMT_Id','=',$request->get('TMT_Id'))
                ->update([
                            'TMT_Observacion_Finaliza'=>$request->get('TMT_Observacion_Finaliza'),
                            'FK_TMT_Estado_id'=>7//finalizado
                    ]
                );
            $articulo = Articulo::find($request->get('TMT_FK_Id_Articulo'));
            $sumarMantenimiento = $articulo->ART_Cantidad_Mantenimiento;
            $sumarMantenimiento ++;
            $articulo->ART_Cantidad_Mantenimiento = $sumarMantenimiento ;
            $articulo->save();
            Solicitudes::
            where('PRT_FK_Articulos_id','=',$request->get('TMT_FK_Id_Articulo'))
                ->update(['PRT_FK_Estado' => 7]);//mantenimiento
            return AjaxResponse::success(
                '¡Solicitud Mantenimiento!',
                'Registrada correctamente.'
            );

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
    public function mantenimientoArticulosAjax(Request $request){
        if($request->ajax() && $request->isMethod('GET')) {
            return view('audiovisuals.articulo.contenidoAjax.mantenimientoArticulosAjax');
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
    public function mantenimientosSolicitadosindex(Request $request){
        if($request->isMethod('GET')) {
            return view('audiovisuals.articulo.gestionMantenimientos');
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
    public function dataTableMantenimientosSolicitadosAdmin(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $mantenimineto = MantenimientoArticulos::with('consultarArticulo')->get();
            return Datatables::of($mantenimineto)
                ->removeColumn('created_at')
                ->removeColumn('updated_at')
                ->addColumn('Acciones', function ($manteni) {
                    if ($manteni->FK_TMT_Estado_id == 7) {
                        return "<span class='label label-sm label-success'>"
                            .'Finalizada'
                            . "</span>";
                    } else {
                        return '<a title="Finalizar Mantenimiento" href="javascript:;" class="btn btn-simple btn-success btn-icon create"><i class="glyphicon glyphicon-ok-circle"></i></a>';
                    }
                })
                ->addColumn('TMT_Observacion_FinalizaO', function ($manteni) {
                    if ($manteni->FK_TMT_Estado_id == 6) {
                        return "<span class='label label-sm label-warning'>"
                            .'Sin Respuesta'
                            . "</span>";
                    } else {
                        return $manteni->TMT_Observacion_Finaliza;
                    }
                })
                ->rawColumns(['Acciones','TMT_Observacion_FinalizaO'])
                ->removeColumn('created_at')
                ->removeColumn('updated_at')
                ->addIndexColumn()->make(true);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar la solicitud.'
        );
    }


}