<?php

namespace App\Container\Autoevaluation\src;

use Illuminate\Database\Eloquent\Model;

class TipoPrograma extends Model
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
    protected $table = 'TBL_Tipo_Programas';

    /**
     * LLave primaria del modelo.
     *
     * @var string
     */
    protected $primaryKey = 'PK_TPR_Id';

    /**
     * Atributos del modelo que pueden ser asignados en masa.
     *
     * @var array
     */
    protected $fillable = ['TPR_Nombre', 'TPR_Descripcion'];
}
