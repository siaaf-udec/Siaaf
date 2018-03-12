<?php

namespace App\Container\Humtalent\src;

use Illuminate\Database\Eloquent\Model;

class Asistent extends Model
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
    protected $table = 'TBL_Asistentes';


    /**
     * Atributos que son asignables.
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
