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
}
