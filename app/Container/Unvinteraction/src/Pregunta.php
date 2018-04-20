<?php

namespace App\Container\Unvinteraction\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Pregunta extends Model
{
     use SoftDeletes;
    /**
     * desactivar opcion de  rellenar casilla update y create date
     *
     * @var string
     */

    public $timestamps = false;
   
    /**
     * Conexión de la base de datos usada por el modelo
     *
     * @var string
     */
 
    protected $connection ='unvinteraction';
    
    /**
     * Conexión de la tabla usada por el modelo
     *
     * @var string
     */

    protected $table = 'TBL_Pregunta';
    
    /**
     * llave primaria utilizada por el modelo
     *
     * @var string
     */

    protected $primaryKey = 'PK_PRGT_Pregunta';
    
    /**
     * casilla utilizadas en la tabla y el modelo
     *
     * @var string
     */
    protected $fillable = ['PRGT_Enunciado','FK_TBL_Tipo_Pregunta_Id'];
 
    /**
     * Atributos que con muteadas
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    /*
    *Función de conexión entre las tablas de TBL_Preguntas y TBL_Evaluacion_Preguntas
    *por los campo de FK_TBL_Pregunta_Id y PK_PRGT_Pregunta
    *para realizar las busquedas complementarias
    */   
    public function preguntaPregunta()
    {
        return $this->hasMany(EvaluacionPreguntas::class, 'FK_TBL_Pregunta_Id', 'PK_PRGT_Pregunta')->withTrashed();
    }
    /*
    *Función de conexión entre las tablas de TBL_Preguntas y TBL_Tipo_Pregunta
    *por los campo de FK_TBL_Tipo_Pregunta_Id y PK_TPPG_Tipo_Pregunta
    *para realizar las busquedas complementarias
    */
    public function preguntaTiposPregunta()
    {
        return $this->belongsto(TipoPregunta::class, 'FK_TBL_Tipo_Pregunta_Id', 'PK_TPPG_Tipo_Pregunta')->withTrashed();
    }
    
}
