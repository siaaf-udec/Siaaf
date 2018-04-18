<?php

namespace App\Container\Audiovisuals\src;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
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
    protected $table = 'TBL_Estados';
    /**
     * Atributos que son asignables.
     *
     * @var array
     */
    protected $fillable = [
        'EST_Descripcion',
    ];
}
