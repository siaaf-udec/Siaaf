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
}
