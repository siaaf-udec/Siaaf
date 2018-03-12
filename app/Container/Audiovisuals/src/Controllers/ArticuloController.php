<?php

namespace App\Container\Audiovisuals\Src\Controllers;

use App\Container\Audiovisuals\src\Articulo;
use App\Container\Audiovisuals\src\Estado;
use App\Container\Audiovisuals\src\Kit;
use App\Container\Audiovisuals\Src\TipoArticulo;
use App\Container\Overall\Src\Facades\AjaxResponse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\DataTables;

class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {	$tiempo = array(
		'9' => 'Libre', '10' => 'Asignado'
		);
        return view('audiovisuals.articulo.gestionArticulos',
            [
			'AsignarTiempo'=>$tiempo,
            ]
        );
    }
	public function dataTableArticulos(Request $request)
	{
		if ($request->ajax() && $request->isMethod('GET')) {
			$articulos = Articulo::with(['consultaTipoArticulo','consultaKitArticulo','consultaEstadoArticulo' ])->get();
			return DataTables::of($articulos)
				->removeColumn('created_at')
				->removeColumn('updated_at')
				->addIndexColumn()
				->make(true);

		} else {
			return AjaxResponse::fail(
				'¡Lo sentimos!',
				'No se pudo completar tu solicitud.'
			);
		}
	}
    public function storeTipoArt(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
			$tiempo=((int)($request['TPART_Tiempo']));
            TipoArticulo::create([
				'TPART_Nombre' => $request['TPART_Nombre'],
				'TPART_Tiempo'=> $tiempo,

			]);
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Tipo de Articulo registrado correctamente.'
            );
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
	public function storeKit(Request $request)
	{
		if ($request->ajax() && $request->isMethod('POST')) {
			Kit::create([
				'KIT_Nombre' => $request['KIT_Nombre'],
				'KIT_FK_Estado_id' => 4,
			]);
			return AjaxResponse::success(
				'¡Bien hecho!',
				'El kit se ha registrado correctamente.'
			);
		} else {
			return AjaxResponse::fail(
				'¡Lo sentimos!',
				'No se pudo completar tu solicitud.'
			);
		}
	}
	public function storeArticulos(Request $request)
	{
		if ($request->ajax() && $request->isMethod('POST')) {
            Articulo::create([
				'FK_ART_Tipo_id' => $request['FK_ART_Tipo_id'],
				'ART_Descripcion' => $request['ART_Descripcion'],
				'FK_ART_Kit_id' => $request['FK_ART_Kit_id'],
				'FK_ART_Estado_id' => 4,
				'ART_Codigo' => $request['ART_Codigo'],
			]);
			return AjaxResponse::success(
				'¡Bien hecho!',
				'El Articulo se ha registrado correctamente.'
			);
		} else {
			return AjaxResponse::fail(
				'¡Lo sentimos!',
				'No se pudo completar tu solicitud.'
			);
		}
	}
    /**
     * Presenta el formulario con los datos para editar el regitro de un articulo.
     *
     * @param  \Illuminate\Http\Request
     * @param  int $id
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function edit(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

            $articulos = Articulo::with(['consultaTipoArticulo','consultaKitArticulo','consultaEstadoArticulo' ])
                ->where('id','=',$id)->get();


            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos cargados correctamente.',
                $articulos
            );
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
	public function ajaxUniqueTipoArt(Request $request)
    {
        if (TipoArticulo::where('TPART_Nombre', $request->get('TPART_Nombre'))->exists()) {
            return \Response::json(false);
        } else {
            return \Response::json(true);
        }
    }
	public function ajaxUniqueKit(Request $request)
	{
		if (Kit::where('KIT_Nombre', $request->get('KIT_Nombre'))->exists()) {
			return \Response::json(false);
		} else {
			return \Response::json(true);
		}
	}
	public function cargarKits(Request $request){
		if($request->ajax() && $request->isMethod('GET')){
			$kit = Kit::all();
			return AjaxResponse::success(
				'¡Bien hecho!',
				'Datos consultados correctamente.',
				$kit
			);
		}else{
			return AjaxResponse::fail(
				'¡Lo sentimos!',
				'No se pudo completar tu solicitud.'
			);
		}
	}
    /**
     * Se realiza la actualización de los Articulos.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function update(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $articulo = Articulo::find($request['id']);
            $articulo->fill($request->all());
            $articulo->save();
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos modificados correctamente.'
            );
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
	public function cargarTipoArticulos(Request $request){
		if($request->ajax() && $request->isMethod('GET')){
			$tiposArticulo = TipoArticulo::all();
			return AjaxResponse::success(
				'¡Bien hecho!',
				'Datos consultados correctamente Articulos.',
				$tiposArticulo
			);
		}else{
			return AjaxResponse::fail(
				'¡Lo sentimos!',
				'No se pudo completar tu solicitud.'
			);
		}
	}
    public function cargarEstadoArticulos(Request $request){
        if($request->ajax() && $request->isMethod('GET')){
            $estadosArticulo = Estado::all();
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos consultados correctamente Articulos.',
                $estadosArticulo
            );
        }else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }

}
