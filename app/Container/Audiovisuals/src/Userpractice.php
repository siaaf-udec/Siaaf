<?php

namespace App\Container\Audiovisuals\src;

use Illuminate\Database\Eloquent\Model;

class Userpractice extends Model
{
    //
	protected $connection = 'audiovisuals';
	protected $table      = "usuariopractica";
	protected $fillable   = ['nombre', 'apellido'];
	public function phones(){
		return $this->hasOne(Phone::class,'user_id','id');
	}
	public function comentarios(){
		return$this->hasMany(Phone::class,'user_id','id');
	}
}
