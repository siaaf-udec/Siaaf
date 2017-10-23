<?php

namespace App\Container\Unvinteraction\src;

use Illuminate\Database\Eloquent\Model;

class TBL_Preguntas extends Model
{
    public $timestamps = false;
    protected $connection ='unvinteraction';
    protected $table = 'TBL_Preguntas';
    protected $primaryKey = 'PK_Preguntas';
    protected $fillable = ['Enunciado','FK_TBL_Tipo_Pregunta'];
    
    public function preguntas_Preguntas()
    {
        return $this->hasMany(TBL_Evaluacion_Preguntas::class, 'FK_TBL_Preguntas', 'PK_Preguntas');
    }
    public function preguntas_tiposPreguntas()
    {
        return $this->belongsto(TBL_Tipo_Pregunta::class, 'FK_TBL_Tipo_pregunta', 'PK_Tipo_Pregunta');
    }
    
}
