<?php

namespace App\Container\Carpark\src\Controllers;

use Illuminate\Http\Request;
use App\Container\Carpark\src\Mail\EmailCarpark;
use Illuminate\Support\Facades\Mail;
use App\Container\Carpark\src\Ingresos;
use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Http\Controllers\Controller;
use App\Container\Carpark\src\Usuarios;

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

            if( $infoEntradas == '[]'){
                $IdError = 422;
                    return AjaxResponse::success(
                        '¡Lo sentimos!',
                        'No existen ingresos activos.',
                        $IdError
                );  
            }
            
            $cuerpoMensaje = 'Advertencia, recuerda que el parqueadero de la Universidad De Cundinamarca cierra a las 22 horas, así que es necesario que por favor saques tu vehículo de allí o se procederá a tomar acciones';

            for ($i = 0; $i < sizeof($infoEntradas); $i++) {
                $infoCorreo = $infoEntradas[$i]['relacionIngresosUsuarios'];
                $subject = $infoCorreo['username'] . ' ' . $infoCorreo['lastname'];
                Mail::send('carpark.correos.plantilla',
                    [
                        'subject' => 'Parqueader UdeC'.': Advertencia Cierre De Parqueadero UdeC',
                        'title' => 'Parqueader UdeC'.': Advertencia Cierre De Parqueadero UdeC',
                        'body' => $cuerpoMensaje,
                        'infoCorreo'=>$infoCorreo, 
                    ],

                   function($message) use ($infoCorreo){
                        
                        $message->from('no-reply@ucundinamarca.edu.co', 'Parqueader UdeC');

                        $message->to($infoCorreo['email']

                    });

               // Mail::to($infoCorreo['email'], 'P1')->send(new EmailCarpark($subject));
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
 


     public function desactivarUsers(Request $request)
      {
        if ($request->ajax() && $request->isMethod('POST')) {

            $infoUsuarios=Usuarios::all();

            if( $infoUsuarios == '[]'){
                $IdError = 422;
                    return AjaxResponse::success(
                        '¡Lo sentimos!',
                        'No existen usuarios activos.',
                        $IdError
                );  
            }
            //inactivar todos los usuarios, estado 2
            for ($i = 0; $i < sizeof($infoUsuarios); $i++) {
                $infoUsuarios[$i]['FK_CU_IdEstado']=2;
                $infoUsuarios[$i]->save();
            }

            

            return AjaxResponse::success(
                '¡Bien hecho!',
                'Usuarios desactivados correctamente.'
            );
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }




}
