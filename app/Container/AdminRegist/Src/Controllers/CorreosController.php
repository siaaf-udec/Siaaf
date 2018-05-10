<?php

namespace App\Container\AdminRegist\src\Controllers;

use Illuminate\Http\Request;
use App\Container\AdminRegist\src\Mail\EmailAdminRegist;
use Illuminate\Support\Facades\Mail;
use App\Container\AdminRegist\src\Sugerencias;
use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Http\Controllers\Controller;

class CorreosController extends Controller
{
    public $help;
    /**
     *Función que redirecciona a la vista de solución de preguntas.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function index(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $help = Sugerencias::find($id);
            return view('adminregist.correos.responderEmail',
                [
                    'help' => $help,
                ]);
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Función que envia los emails de la solución de las diferentes preguntas realizadas.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function enviarMail(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $help = Sugerencias::find($request['id']);
            $this->help = $help;

            $cuerpoMensaje = "La solución a su pregunta realizada en el area de admisiones y registro es la siguiente: ";
            $data = ['subject' => $help->SU_Respuesta,
                'title' => $help->SU_Username,
                'body' => $cuerpoMensaje,
                'pregunta' => 'Pregunta: '.$help->SU_Pregunta,
                'respuesta' => 'Respuesta: '.$request['respuesta']];
            Mail::send('adminregist.correos.plantilla', $data, function ($message) {

                $message->from('no-reply@ucundinamarca.edu.co', 'Admisiones y Registro');

                $message->to($this->help->SU_Email)->subject($this->help->SU_Username);

            });
            $help->SU_Respuesta = $request['respuesta'];
            $help->SU_Estado = 'Resuelta';
            $help->save();
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