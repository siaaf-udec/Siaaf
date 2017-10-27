<?php

namespace App\Container\Humtalent\src;

use Illuminate\Database\Eloquent\Model;

class Asistent extends Model
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
    protected $table = 'TBL_Asistentes';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'FK_TBL_Eventos_IdEvento', 'FK_TBL_Persona_Cedula',
    ];


    /**
     *  Función que retorna la relación entre la tabla 'tbl_personas' y la tabla 'tbl_asistentes'
     *  a través de la llave foránea 'FK_TBL_Persona_Cedula' y la llave 'PK_PRSN_Cedula'
     */
    public function personas()
    {
        return $this->belongsTo(Persona::class, 'FK_TBL_Persona_Cedula', 'PK_PRSN_Cedula');
    }

    /**
     *  Función que retorna la relación entre la tabla 'tbl_eventos' y la tabla 'tbl_asistentes'
     *  a través de la llave foránea 'FK_TBL_Eventos_IdEvento'
     */
    public function events()
    {
        return $this->belongsTo(Event::class, 'FK_TBL_Eventos_IdEvento');
    }

}
