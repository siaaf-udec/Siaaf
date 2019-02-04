<?php

namespace App\Container\Gesap\src\Mail;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailGesap extends Mailable implements ShouldQueue
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
        $cuerpoMensaje = 'Señor usuario, se ha creado un perfil con sus datos por favor ingrese al siguiente el link para confirmar.';

        return $this->from(['address' => 'no-reply@ucundinamarca.edu.co', 'name' => 'Usuarios GESAP'])
            ->with([
                'subject' => $this->nombre.': Creación de nuevo usaurio GESAP',
                'title' => $this->nombre.': Creación de nuevo usaurio GESAP',
                'body' => $cuerpoMensaje,
            ])->view('gesap.Coordinador.Usuarios');      
    }
}
