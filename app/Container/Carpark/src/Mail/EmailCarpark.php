<?php

namespace App\Container\Carpark\src\Mail;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailCarpark extends Mailable implements ShouldQueue
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

    /**
     * Create a new message instance.
     *
     * @param $nombre
     *
     */
    public function __construct($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $cuerpoMensaje = 'Advertencia, recuerda que el parqueadero de la Universidad De Cundinamarca cierra a las 22 horas, así que es necesario que por favor saques tu vehículo de allí o se procederá a tomar acciones';

        return $this->from(['address' => 'no-reply@ucundinamarca.edu.co', 'name' => 'Cierre Parqueader UdeC'])
            ->with([
                'subject' => $this->nombre.': Advertencia Cierre De Parqueadero UdeC',
                'title' => $this->nombre.': Advertencia Cierre De Parqueadero UdeC',
                'body' => $cuerpoMensaje
            ])
            ->view('carpark.correos.plantilla');      

    }


}
