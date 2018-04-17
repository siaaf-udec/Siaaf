<?php

namespace App\Container\Audiovisuals\src;

use Illuminate\Database\Eloquent\Model;

class Programas extends Model
{
    //
	protected $connection = 'audiovisuals';
	protected $table      = "tbl_programas";
	protected $fillable   = ['id', 'PRO_Nombre'];
}
