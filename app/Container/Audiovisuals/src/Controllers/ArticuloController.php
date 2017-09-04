<?php

namespace App\Container\Audiovisuals\Src\Controllers;

use App\Container\Audiovisuals\src\Articulo;
use App\Container\Audiovisuals\src\Estado;
use App\Container\Audiovisuals\src\Kit;
use App\Container\Audiovisuals\Src\TipoArticulo;
use App\Container\Overall\Src\Facades\AjaxResponse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipo   = TipoArticulo::all()->pluck('TPART_Nombre', 'id');
        $kit    = Kit::all()->pluck('KIT_Nombre', 'id');
        $estado = Estado::all()->pluck('EST_Descripcion', 'id');
        $consultaTipo = Articulo::with(['consultaTipoArticulo' ])->get();


        return view('audiovisuals.articulo.gestionArticulos',
            [
			'programas' => $tipo->toArray(),
                'kit'       => $kit->toArray(),
                'estado'       => $estado->toArray(),
                'tipo' =>$consultaTipo,
            ]
        );

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
	public function data(Request $request)
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
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeTipoArt(Request $request)
    {

        if ($request->ajax() && $request->isMethod('POST')) {

            TipoArticulo::create([
				'TPART_Nombre' => $request['TPART_Nombre'],
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
				'FK_ART_Estado_id' => 1,
				'ART_Codigo' => $request['ART_Codigo'],
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

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


	/**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
