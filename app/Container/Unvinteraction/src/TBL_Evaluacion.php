<?php

namespace App\Container\Unvinteraction\src;

use Illuminate\Database\Eloquent\Model;

class TBL_Evaluacion extends Model
{
    //
    public $timestamps = false;
    protected $connection = 'unvinteraction';
    protected $table = 'TBL_Evaluacion';
    protected $primaryKey = 'PK_evaluacion';
    protected $fillable = [
        'FK_TBL_Convenios','FK_TBL_Preguntas'];
}
