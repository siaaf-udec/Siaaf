<?php

namespace App\Container\Unvinteraction\src;

use Illuminate\Database\Eloquent\Model;

class TBL_Tipo_Pregunta extends Model
{
    public $timestamps = false;
    protected $connection ='unvinteraction';
    protected $table = 'TBL_Tipo_Pregunta';
    protected $primaryKey = 'PK_Tipo_Pregunta';
    protected $fillable = ['Tipo'];
    public function preguntas_tiposPreguntas()
    {
        return $this->belongsto(TBL_Preguntas::class, 'FK_TBL_Tipo_pregunta', 'PK_Tipo_Preguntas');
    }
}
