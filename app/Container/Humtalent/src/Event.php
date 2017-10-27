<?php

namespace App\Container\Humtalent\src;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    /**
     * The database connection used by the model.
     *
     * @var string
     */
    protected $connection = 'humtalent';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'TBL_Eventos';

    /**
     * The database key used by the model.
     *
     * @var string
     */
    protected $primaryKey = 'PK_EVNT_IdEvento';

    /**
     * The attributes that are mass assignable.
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
