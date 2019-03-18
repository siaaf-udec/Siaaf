<?php

namespace App\Container\Gesap\src;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{

    protected $connection = 'gesap';

    //la tabla
     protected $table = 'TBL_Actividades';
 
     //la pk
     protected $primaryKey = 'PK_CTVD_IdActividad';
     
     //las q se llenan
     protected $fillable = ['CTVD_Nombre', 'CTVD_Descripcion','CTVD_Default','FK_Id_Formato'];
 
    protected $dates = ['deleted_at'];

    /*
	*Función de relacion entre las tablas de Actividad y Documentos 
	*por los campo de FK_TBL_Actividad_Id y PK_CTVD_IdActividad 
	*para realizar las busquedas complementarias
	
    public function documentos()
    {
        return $this->hasMany(Documentos::class, 'FK_TBL_Actividad_Id', 'PK_CTVD_IdActividad');
    }
    */
}
