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
		'PRT_Observacion_Recibe','PRT_FK_Estado','PRT_FK_Tipo_Solicitud',
		'PRT_FK_Administrador_Entrega_id','PRT_FK_Administrador_Recibe_id'
	];
	//registrar id del administrador logeado
	//hacer update en campo entrega id administrador
//crear metodo para consultar administradores
}
