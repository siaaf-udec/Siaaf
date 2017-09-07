<?php

namespace App\Container\Audiovisuals\Src\Controllers;

use App\Container\Audiovisuals\src\Solicitudes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;


class AdministradorGestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //FUNCION VISTA PRINCIPAL GESTION ADMINISTRADOR
    public function index()
    {
        //

		return view('audiovisuals.administrador.gestionPrestamos');
    }
    //FUNCION VISTA AJAX GESTION RESERVAS ADMINISTRADOR
	public function reservaIndex(Request $request){
		if($request->ajax() && $request->isMethod('GET')){
			$solicitudes = Solicitudes::with(
				['consultaTipoArticulo','consultaUsuarioAudiovisuales','conultarUsuarioDeveloper']
			)->get();
			return view('audiovisuals.administrador.contenidoAjax.ajaxReservas', [
					'solicitudes' => json_encode($solicitudes)
			]);
		}else{
			return AjaxResponse::fail(
				'¡Lo sentimos!',
				'No se pudo completar tu solicitud.'
			);
		}
	}
	//FUNCION PARA LISTAR LA DATATABLE DE RESERVAS DE LOS FUNCIONARIOS EN GESTION RESERVAS
	public function dataReservasFuncionarios(Request $request){

		if ($request->ajax() && $request->isMethod('GET')) {
			$solicitudes = Solicitudes::with(
				['consultaTipoArticulo','consultaUsuarioAudiovisuales','conultarUsuarioDeveloper']
			)->get();
			$solicitudes=json_decode($solicitudes);
			return Datatables::of($solicitudes)
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
