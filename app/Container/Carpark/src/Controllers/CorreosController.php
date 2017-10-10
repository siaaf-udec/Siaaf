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
use Mail;
use Session;

class CorreosController extends Controller
{
    /**
     * Muestra el boton para cerrar el parqueadero y enviar los correos de advertencia a los usuarios que aún tienen su vehículo en la universidad.
     *
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function cerrarParqueadero()
    {

        return view('carpark.correos.cerrarPark');
    }
    
    public function enviarMail(Request $request)
    {
        if($request->ajax() && $request->isMethod('POST'))
        {
            $infoEntradas = Ingresos::with('relacionIngresosUsuarios')->get();
            for ($i = 0; $i < sizeof($infoEntradas); $i++) {
                $infoCorreo = $infoEntradas[$i]['relacionIngresosUsuarios'];

                Mail::send('carpark.correos.plantilla', ['user' => $infoCorreo], function ($msj) use ($infoCorreo) {
                    $msj->subject('Advertencia De Cierre Del Parqueadero');
                    $msj->to($infoCorreo['CU_Correo']);
                    Session::flash('message', 'mensaje enviado correctamente');
                });
            }

            return AjaxResponse::success(
                '¡Bien hecho!',
                'Correos Enviados Correctamente.'
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

    
}
