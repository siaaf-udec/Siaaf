<?php

namespace App\Container\Audiovisuals\src;

use Illuminate\Database\Eloquent\Model;

class Validaciones extends Model
{
    //
    protected $connection = 'audiovisuals';
    protected $table      = "TBL_Validaciones";
	protected $fillable = [

		'VAL_PRE_Nombre','VAL_PRE_Valor'
	];
	//registrar id del administrador logeado
	//hacer update en campo entrega id administrador
	//crear metodo para consultar administradores

	//metodo de relacion con la tabla tipo articulos
	public function consultaTimepoArticulo(){
		return $this->hasMany(TipoArticulo::class,'TPART_Tiempo','id');
	}
	public function consultaUsuarioAudiovisuales()
	{
		return $this->belongsTo(UsuarioAudiovisuales::class,'PRT_FK_Funcionario_id','id');
	}
	public function	conultarUsuarioDeveloper(){
		return $this->belongsTo('App\Container\Users\Src\User','PRT_FK_Funcionario_id','id');
	}
	public function consultaKitArticulo()
	{
		return $this->belongsTo(Kit::class,'PRT_FK_Kits_id','id');
	}
	public function consultaTipoArticulo()
	{
		return $this->belongsTo(
			TipoArticulo::class,'PRT_FK_Articulos_id','id'
		);
	}
	public function consultaUsuario()
	{
		return $this->belongsTo(
			UsuarioAudiovisuales::class,'PRT_FK_Funcionario_id','id'
		);
	}
}
