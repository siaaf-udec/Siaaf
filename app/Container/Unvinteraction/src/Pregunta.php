<?php

namespace App\Container\Unvinteraction\src;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    public $timestamps = false;
    protected $connection ='unvinteraction';
    protected $table = 'TBL_Pregunta';
    protected $primaryKey = 'PK_PRGT_Pregunta';
    protected $fillable = ['PRGT_Enunciado','FK_TBL_Tipo_Pregunta_Id'];
 
    /*
    *Función de conexión entre las tablas de TBL_Preguntas y TBL_Evaluacion_Preguntas
    *por los campo de FK_TBL_Preguntas y PK_Preguntas
    *para realizar las busquedas complementarias
    */   
    public function preguntaPregunta()
    {
        return $this->hasMany(EvaluacionPreguntas::class, 'FK_TBL_Pregunta_Id', 'PK_PRGT_Pregunta');
    }
    /*
    *Función de conexión entre las tablas de TBL_Preguntas y TBL_Tipo_Pregunta
    *por los campo de FK_TBL_Tipo_pregunta y PK_Tipo_Pregunta
    *para realizar las busquedas complementarias
    */
    public function PreguntatiposPregunta()
    {
        return $this->belongsto(TipoPregunta::class, 'FK_TBL_Tipo_Pregunta_Id', 'PK_TPPG_Tipo_Pregunta');
    }
    
}
