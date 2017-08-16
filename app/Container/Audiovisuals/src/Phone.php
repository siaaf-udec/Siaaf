<?php

namespace App\Container\Audiovisuals\src;

use App\Container\Users\Src\User;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    //
	protected $connection = 'audiovisuals';
	protected $table      = "telefono";
	protected $fillable   = ['user_id', 'nombre'];

	public function consultaUsuario(){
		return $this->belongsTo(Userpractice::class,'user_id','id')->withDefault();
	}
}
