<?php

namespace App\Container\AdminRegist\Src;

use Illuminate\Database\Eloquent\Model;

class Sugerencias extends Model
{
    protected $connection = 'adminregist';
    protected $table = 'TBL_Sugerencias';
    protected $primaryKey = 'PK_SU_IdSugerencia';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'SU_Pregunta','SU_Email','SU_Username','SU_Respuesta','SU_Estado'
    ];
}