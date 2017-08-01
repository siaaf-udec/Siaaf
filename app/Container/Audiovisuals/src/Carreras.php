<?php

namespace App\Container\Audiovisuals\src;

use Illuminate\Database\Eloquent\Model;

class Carreras extends Model
{
    //
    protected $connection = 'audiovisuals';
    protected $table      = "carreras";
    protected $fillable   = ['id', 'nombre'];
}
