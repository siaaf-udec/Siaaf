<?php

namespace App\Container\Autoevaluation\src;

use Illuminate\Database\Eloquent\Model;

class Lineamiento extends Model
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
    protected $table = 'TBL_Lineamientos';

    /**
     * LLave primaria del modelo.
     *
     * @var string
     */
    protected $primaryKey = 'PK_LNM_Id';

    /**
     * Atributos del modelo que no pueden ser asignados en masa.
     *
     * @var array
     */
    protected $guarded = ['PK_LNM_Id', 'created_at', 'updated_at'];
}
