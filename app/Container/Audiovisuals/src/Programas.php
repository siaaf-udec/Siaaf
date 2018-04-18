<?php

namespace App\Container\Audiovisuals\src;

use Illuminate\Database\Eloquent\Model;

class Programas extends Model
{
    /**
     * Conexión de la base de datos usada por el modelo
     *
     * @var string
     */
	protected $connection = 'audiovisuals';
    /**
     * Tabla utilizada por el modelo.
     *
     * @var string
     */
	protected $table      = "TBL_Programas";
    /**
     * Atributos que son asignables.
     *
     * @var array
     */
	protected $fillable   = ['id', 'PRO_Nombre'];
}
