<?php

namespace App\Container\Audiovisuals\src;

use Illuminate\Database\Eloquent\Model;

class UsuarioAudiovisuales extends Model
{
    //
	protected $connection = 'audiovisuals';
	protected $table = 'tbl_usuario_audiovisuales';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'USER_FK_User', 'USER_FK_Programa'
	];
	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [

	];

	/*
	* morphTo() Transformarce a..
	*/
	//seoble, likeable, votable....
	public function user()
	{
		return $this->belongsTo('App\Container\Users\Src\User', 'USER_FK_User');
	}
}
