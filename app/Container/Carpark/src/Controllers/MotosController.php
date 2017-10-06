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
use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

class MotosController extends Controller
{
    /**
     * Muestra todos los vehículos registrados.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('carpark.motos.tablaMotos');
    }

    /**
     * Muestra todos los usuarios registradas por medio de una petición ajax.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function indexAjax (Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET'))
        {
            return view('carpark.motos.ajaxTablaMotos');
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
     * Función que muestra el formulario de registro de un nuevo vehiculo.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create (Request $request,$id)//
    {
        if($request->ajax() && $request->isMethod('GET'))
        {
            $codigoUsuario = $id;
            return view('carpark.motos.registroMoto',
                [
                    'codigoUsuario' =>  $codigoUsuario,
                ]);
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
     * Función que almacena en la base de datos un nuevo vehículo.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store (Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST'))
        {
                          
            $imgMoto = $request->file('CM_UrlFoto');
            $imgProp = $request->file('CM_UrlPropiedad');
            $imgSOAT = $request->file('CM_UrlSoat');
            $urlMoto = Storage::disk('developer')->putFile('carpark/usuarios', $imgMoto);
            $urlMoto = "developer/".$urlMoto;
            $urlProp = Storage::disk('developer')->putFile('carpark/usuarios', $imgProp);
            $urlProp = "developer/".$urlProp;
            $urlSOAT = Storage::disk('developer')->putFile('carpark/usuarios', $imgSOAT);
            $urlSOAT = "developer/".$urlSOAT;
            $generadorID = date_create();


            Motos::create([
                'PK_CM_IdMoto'     => date_timestamp_get($generadorID),
                'CM_Placa'         => strtoupper($request['CM_Placa']),
                'CM_Marca'         => $request['CM_Marca'],
                'CM_NuPropiedad'   => $request['CM_NuPropiedad'],
                'CM_NuSoat'        => $request['CM_NuSoat'],               
                'CM_fechaSoat'     => $request['CM_fechaSoat'],
                'CM_UrlFoto'       => $urlMoto,
                'CM_UrlPropiedad'  => $urlProp,                
                'CM_UrlSoat'       => $urlSOAT,
                'FK_CM_CodigoUser' => $request['FK_CM_CodigoUser'],                
            ]);
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos almacenados correctamente.'
            );                
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
     * Presenta el formulario con los datos para editar el regitro de un vehículo deseado.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editar(Request $request, $id)
    {
        if($request->ajax() && $request->isMethod('GET'))
        {
            $infoMoto = Motos::find($id);
            
            return view('carpark.motos.editarMoto',
                [
                    'infoMoto' => $infoMoto,
                ]);
        }
        else
        {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu Controller.'
            );
        }
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

    /**
     * Muestra el perfil de un vehículo especifico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function verMoto(Request $request, $id)
    {
        if($request->ajax() && $request->isMethod('GET'))
        {
            $infoMoto = Motos::find($id);
            $infoUsuario = Usuarios::find($infoMoto['FK_CM_CodigoUser']);                        

            return view('carpark.motos.perfilMoto',
                [
                    'infoMoto'    => $infoMoto,
                    'infoUsuario' => $infoUsuario,
                ]);
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
