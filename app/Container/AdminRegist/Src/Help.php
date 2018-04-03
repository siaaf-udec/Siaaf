<?php

namespace App\Container\AdminRegist\Src;

use Illuminate\Database\Eloquent\Model;

class Help extends Model
{
    protected $connection = 'adminregist';
    protected $table = 'help';
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pregunta', 'respuesta'
    ];





}