<?php

namespace App\Container\Unvinteraction\src;

use Illuminate\Database\Eloquent\Model;

class EvaluacionPregunta extends Model
{
    //
    public $timestamps = false;
    protected $connection = 'unvinteraction';
    protected $table = 'TBL_Evaluacion_Pregunta';
    protected $primaryKey = 'PK_VCPT_Evaluacion_Pregunta';
    protected $fillable = ['VCPT_Puntuacion','FK_TBL_Evaluacion_Id','FK_TBL_Pregunta_Id'];
    
    /*
    *Función de conexión entre la tabla TBL_Evaluacion_Preguntas y TBL_Evaluacion
    *por los campo de FK_TBL_Evaluacion y PK_Evaluacion
    *para realizar las busquedas complementarias
    */ 
    public function evaluacionPregunta()
    {
        return $this->belongsto(Evaluacion::class, 'FK_TBL_Evaluacion_Id','PK_VLCN_Evaluacion');
    }
    
    /*
    *Función de conexión entre la tabla TBL_Evaluacion_Preguntas y TBL_Preguntas
    *por los campo de FK_TBL_Preguntas y PK_Preguntas
    *para realizar las busquedas complementarias
    */ 
    public function preguntaPregunta()
    {
        return $this->belongsto(Preguntas::class, 'FK_TBL_Pregunta_Id', 'PK_PRGT_Pregunta');
    }
}
