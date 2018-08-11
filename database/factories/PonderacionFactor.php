<?php

namespace App\Container\Autoevaluation\src;

use Illuminate\Database\Eloquent\Model;

class PonderacionFactor extends Model
{
    /**
     * Nombre de la conexion utilizada por el modelo.
     *
     * @var string
     */
    protected $connection = 'autoevaluation';

    /**
     * Tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'TBL_Ponderacion_Factor';

    /**
     * LLave primaria del modelo.
     *
     * @var string
     */
    protected $primaryKey = 'PK_POF_Id';

    /**
     * Atributos del modelo que no pueden ser asignados en masa.
     *
     * @var array
     */
    protected $guarded = ['PK_POF_Id', 'created_at', 'updated_at'];
}
