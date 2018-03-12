<?php

namespace App\Container\Humtalent\src;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    /**
     * Conexión de la base de datos usada por el modelo
     *
     * @var string
     */
    protected $connection = 'humtalent';

    /**
     * Tabla utilizada por el modelo.
     *
     * @var string
     */
    protected $table = 'TBL_Eventos';

    /**
     * Llave utilizada por el modelo.
     *
     * @var string
     */
    protected $primaryKey = 'PK_EVNT_IdEvento';

    /**
     * Atributos que son asignables.
     *
     * @var array
     */
    protected $fillable = [

        'EVNT_Descripcion', 'EVNT_Fecha_Inicio', 'EVNT_Fecha_Fin', 'EVNT_Fecha_Notificacion', 'EVNT_Hora',
    ];


    /**
     *  Función que retorna la relación entre la tabla 'tbl_asistentes' y la tabla 'tbl_eventos'
     *  a través de la llave 'PK_EVNT_IdEvento'
     */
    public function asistents()
    {
        return $this->hasMany(Asistent::class, 'PK_EVNT_IdEvento');
    }
}
