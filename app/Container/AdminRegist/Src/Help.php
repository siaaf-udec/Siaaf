<?php

namespace App\Container\AdminRegist\Src;

use Illuminate\Database\Eloquent\Model;

class Help extends Model
{
    protected $connection = 'adminregist';
    protected $table = 'TBL_Help';
    protected $primaryKey = 'PK_HE_IdHelp';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'HE_Pregunta', 'HE_Respuesta'
    ];





}