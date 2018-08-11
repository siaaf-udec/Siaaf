<?php

namespace App\Container\Autoevaluation\src;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
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
    protected $table = 'TBL_Actividades';

    /**
     * LLave primaria del modelo.
     *
     * @var string
     */
    protected $primaryKey = 'PK_ACT_Id';

    /**
     * Atributos del modelo que no pueden ser asignados en masa.
     *
     * @var array
     */
    protected $guarded = ['PK_ACT_Id', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rol(){
        return $this->belongsTo(Rol::class, 'FK_ACT_Roles', 'PK_Rol_Id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function grupo(){
        return $this->belongsTo(Grupo::class, 'FK_ACT_Grupos', 'PK_GRP_Id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subgrupo(){
        return $this->belongsTo(Subgrupo::class, 'FK_ACT_Subgrupos', 'PK_SGP_Id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estado(){
        return $this->belongsTo(Estado::class, 'FK_ACT_Estado', 'PK_ESD_Id');
    }



}
