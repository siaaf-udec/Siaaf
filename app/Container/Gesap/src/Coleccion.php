<?php

namespace App\container\Gesap\src;

use Illuminate\Database\Eloquent\Model;

class Coleccion extends Model
{

    protected $connection = 'gesap';
  
     protected $table = 'TBL_Coleccion';

     //la pk
     protected $primaryKey = 'PK_Coleccion';
     
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
