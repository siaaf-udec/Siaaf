<?php

namespace App\container\gesap\src;

use Illuminate\Database\Eloquent\Model;

class Conceptos extends Model
{
    protected $connection = 'gesap';

    protected $table = 'TBL_Conceptos';

    protected $primaryKey = 'PK_CNPT_Conceptos';

    protected $fillable = ['CNPT_Concepto','CNPT_Tipo','FK_TBL_Encargado_Id'];
    
	/*
	*Función de relacion entre las tablas de Conceptos y Encargados 
	*por los campo de FK_TBL_Encargado_Id y PK_NCRD_IdCargo 
	*seleccionando los campos PK_NCRD_IdCargo, FK_TBL_Anteproyecto_Id, FK_Developer_User_Id, NCRD_Cargo
	*y utilizando la funcion de relacion de usuarios para obtener el nombre del encargado de la observacion
	*para realizar las busquedas complementarias
	*/
    public function encargado()
    {
        return $this->belongsTo(Encargados::class, 'FK_TBL_Encargado_Id', 'PK_NCRD_IdCargo')
            ->select("PK_NCRD_IdCargo", "FK_TBL_Anteproyecto_Id", "FK_Developer_User_Id", "NCRD_Cargo")
            ->with(['usuarios'=>function ($usuarios) {
                            $usuarios->select('name', 'lastname', 'id');
            }]);
    }
	
}
