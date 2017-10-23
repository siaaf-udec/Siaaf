<?php

namespace App\Container\Audiovisuals\src;

use Illuminate\Database\Eloquent\Model;

class Solicitudes extends Model
{
    //
    protected $connection = 'audiovisuals';
    protected $table      = "tbl_prestamos";
	protected $fillable = [
		'PRT_FK_Articulos_id','PRT_FK_Funcionario_id','PRT_FK_Kits_id',
		'PRT_Fecha_Inicio','PRT_Fecha_Fin','PRT_Observacion_Entrega',
		'PRT_Observacion_Recibe','PRT_Num_Orden','PRT_Cantidad','PRT_FK_Estado','PRT_FK_Tipo_Solicitud',
		'PRT_FK_Administrador_Entrega_id','PRT_FK_Administrador_Recibe_id'
	];
	//registrar id del administrador logeado
	//hacer update en campo entrega id administrador
	//crear metodo para consultar administradores

	//metodo de relacion con la tabla tipo articulos
    public function consultaArticulos()
    {
        return $this->belongsTo(Articulo::class,'PRT_FK_Articulos_id');
    }
	public function consultaUsuarioAudiovisuales()
	{
		return $this->belongsTo(UsuarioAudiovisuales::class,'PRT_FK_Funcionario_id','USER_FK_User');
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
    /*public function consultaTipoArticulo()
    {
        return $this->belongsTo(
            TipoArticulo::class,'PRT_FK_Articulos_id','id'
        );
    }*/
	public function consultaUsuario()
	{
		return $this->belongsTo(
			UsuarioAudiovisuales::class,'PRT_FK_Funcionario_id','id'
		);
	}
}
