<?php

namespace App\container\gesap\src;

use Illuminate\Database\Eloquent\Model;

class Documentos extends Model
{
    protected $connection = 'gesap';

    protected $table = 'TBL_Documentos';

    protected $primaryKey = 'PK_DMNT_IdProyecto';

    protected $fillable = ['DMNT_Nombre','DMNT_Descripcion','DMNT_Archivo','FK_TBL_Proyecto_Id'];

	/*
	*Función de relacion entre las tablas de Documentos y proyecto 
	*por los campo de FK_TBL_Proyecto_Id y PK_PRYT_IdProyecto 
	*para realizar las busquedas complementarias
	*/
    public function proyecto()
    {
        return $this->belongsto(Proyecto::class, 'FK_TBL_Proyecto_Id', 'PK_PRYT_IdProyecto');
    }
}
