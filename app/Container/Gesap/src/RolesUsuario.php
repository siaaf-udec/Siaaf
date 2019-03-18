<?php

namespace App\Container\Gesap\src;

use Illuminate\Database\Eloquent\Model;

class RolesUsuario extends Model
{
    //la base
   protected $connection = 'gesap';

   //la tabla
    protected $table = 'TBL_Rol';

    //la pk
    protected $primaryKey = 'PK_Id_Rol_Usuario';
    
    //las q se llenan
    protected $fillable = ['Rol_Usuario', 'Rol_Descripcion'];

    
    /*
	*Función de relacion entre las tablas de Actividad y Documentos 
	*por los campo de FK_TBL_Actividad_Id y PK_CTVD_IdActividad 
	*para realizar las busquedas complementarias
	
    public function documentos()
    {
        return $this->hasMany(Documentos::class, 'FK_TBL_Actividad_Id', 'PK_CTVD_IdActividad');
    }
    */

    //Relacion del Rol con el Usuario
    public function relacionRolUsuario()
    {
        return $this->belongsTo(Usuarios::class,'PK_Id_Rol_Usuario','FK_User_IdRol');
    }
}
