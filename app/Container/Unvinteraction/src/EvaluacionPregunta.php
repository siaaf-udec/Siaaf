<?php

namespace App\Container\Unvinteraction\src;

use Illuminate\Database\Eloquent\Model;

class EvaluacionPregunta extends Model
{
    
    
    /**
     * Conexión de la base de datos usada por el modelo
     *
     * @var string
     */
 
    protected $connection = 'unvinteraction';
    
    /**
     * Conexión de la tabla usada por el modelo
     *
     * @var string
     */

    protected $table = 'TBL_Evaluacion_Pregunta';
    
    /**
     * llave primaria utilizada por el modelo
     *
     * @var string
     */

    protected $primaryKey = 'PK_VCPT_Evaluacion_Pregunta';
    
    /**
     * casilla utilizadas en la tabla y el modelo
     *
     * @var string
     */
    protected $fillable = ['VCPT_Puntuacion','FK_TBL_Evaluacion_Id','FK_TBL_Pregunta_Id'];
    
    /*
    *Función de conexión entre la tabla TBL_Evaluacion_Preguntas y TBL_Evaluacion
    *por los campo de FK_TBL_Evaluacion y PK_Evaluacion
    *para realizar las busquedas complementarias
    */ 
    public function evaluacionPregunta()
    {
        return $this->belongsto(Evaluacion::class, 'FK_TBL_Evaluacion_Id','PK_VLCN_Evaluacion')->withTrashed();
    }
    
    /*
    *Función de conexión entre la tabla TBL_Evaluacion_Preguntas y TBL_Preguntas
    *por los campo de FK_TBL_Preguntas y PK_Preguntas
    *para realizar las busquedas complementarias
    */ 
    public function preguntaPregunta()
    {
        return $this->belongsto(Pregunta::class, 'FK_TBL_Pregunta_Id', 'PK_PRGT_Pregunta')->withTrashed();
    }
}
