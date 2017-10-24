<?php

namespace App\Container\Carpark\src\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailCarpark extends Mailable
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

    public $asunto;

    /**
     * Create a new message instance.
     *
     * @param $asunto
     * @param $message
     *
     */
    public function __construct($asunto)
    {
        $this->asunto = $asunto;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $cuerpoMensaje = 'Advertencia, recuerda que el parqueadero de la Universidad De Cundinamarca cierra a las 22 horas, así que es necesario que por favor saques tu vehículo de allí o se procederá a tomar acciones';
        return $this->from(['address' => 'no-reply@ucundinamarca.edu.co', 'name' => env('APP_NAME')])->view('carpark.correos.plantilla', ['title' => $this->asunto, 'body' => $cuerpoMensaje]);        

    }


}
