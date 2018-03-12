<?php

namespace App\Container\Acadspace\src;

use Illuminate\Database\Eloquent\Model;

class Calendario extends Model
{
    /**
     * Conexión de la base de datos usada por el modelo
     * @var string
     */
    protected $connection = 'acadspace';

    /**
     * Tabla utilizada por el modelo.
     * @var string
     */
    protected $table = 'TBL_Calendario';

    /**
     * Llave primaria usada por el modelo
     */
    protected $primaryKey = 'PK_CAL_Id';

    /**
     * Atributos que son asignables.
     * @var array
     */
    protected $fillable = [
        'CAL_Fecha_Ini',
        'CAL_Fecha_Fin',
        'CAL_Color',
        'CAL_Titulo',
        'CAL_Sala'
    ];

}