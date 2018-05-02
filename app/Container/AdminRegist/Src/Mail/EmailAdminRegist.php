<?php

namespace App\Container\AdminRegist\src\Mail;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailAdminRegist extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 3;
    /**
     * @var
     */

    public $nombre;
    public $pregunta;
    public $respuesta;

    /**
     * Create a new message instance.
     *
     * @param $nombre
     *
     */
    public function __construct($nombre,$pregunta,$respuesta)
    {
        $this->nombre = $nombre;
        $this->pregunta = $pregunta;
        $this->respuesta = $respuesta;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $cuerpoMensaje = 'La solución a su pregunta realizada en el area de admisiones y registro es la siguiente'.'\n'.'Pregunta: '.$this->pregunta.'\n'.'Respuesta: '.$this->respuesta;

        return [
                'subject' => $this->nombre,
                'title' => $this->nombre,
                'body' => $cuerpoMensaje
            ];

    }


}
