<?php

namespace App\Container\Carpark\src\Controllers;

use Illuminate\Http\Request;
use App\Container\CArpark\src\Mail\EmailCarpark;
use Illuminate\Support\Facades\Mail;
use App\Container\Carpark\src\Ingresos;
use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Http\Controllers\Controller;

class CorreosController extends Controller
{
    /**
     * Muestra el boton para cerrar el parqueadero y enviar los correos de advertencia a los usuarios que aún tienen su vehículo en la universidad.
     *
     * @return \Illuminate\Http\Response
     */
    public function cerrarParqueadero()
    {

        return view('carpark.correos.cerrarPark');
    }

    /**
     * Función que envia los emails de advertencia.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function enviarMail(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            $infoEntradas = Ingresos::with('relacionIngresosUsuarios')->get();
            for ($i = 0; $i < sizeof($infoEntradas); $i++) 
            {
                $infoCorreo = $infoEntradas[$i]['relacionIngresosUsuarios'];
                $subject = $infoCorreo['CU_Nombre1'].' '.$infoCorreo['CU_Apellido1']; 
                Mail::to($infoCorreo['CU_Correo'], 'P1')->send(new EmailCarpark($subject));
            }

            return AjaxResponse::success(
                '¡Bien hecho!',
                'Mensaje enviado correctamente.'
            );
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

}
