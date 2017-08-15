<?php

namespace App\Container\Audiovisuals\src;

use Illuminate\Database\Eloquent\Model;

class Solicitudes extends Model
{
    //
    protected $connection = 'audiovisuals';
    protected $table      = "tbl_prestamos";
}
