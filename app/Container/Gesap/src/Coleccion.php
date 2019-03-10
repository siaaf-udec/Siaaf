<?php

namespace App\container\Gesap\src;

use Illuminate\Database\Eloquent\Model;

class Coleccion extends Model
{

    protected $connection = 'gesap';

    //la tabla
     protected $table = 'TBL_coleccion';
 
     //la pk
     protected $primaryKey = 'PK_coleccion';
     
     //las q se llenan
    

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
