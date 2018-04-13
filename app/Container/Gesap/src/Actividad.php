<?php

namespace App\container\gesap\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Actividad extends Model
{
    
   use SoftDeletes;
    /**
     * Conexión de la base de datos usada por el modelo
     *
     * @var string
     */
    protected $connection = 'gesap';

    /**
     * Tabla utilizada por el modelo.
     *
     * @var string
     */
    protected $table = 'TBL_Actividades';

 /**
     * Nombre de columna primary_key de tabla .
     *
     * @var string
     */
    protected $primaryKey = 'PK_CTVD_IdActividad';

 /**
     * Atributos que son asignables.
     *
     * @var array
     */
    protected $fillable = ['CTVD_Nombre','CTVD_Descripcion','CTVD_Default'];
    
    /**
     * Atributos que con muteadas
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
	/*
	*Función de relacion entre las tablas de Actividad y Documentos 
	*por los campo de FK_TBL_Actividad_Id y PK_CTVD_IdActividad 
	*para realizar las busquedas complementarias
	*/
    public function documentos()
    {
        return $this->hasMany(Documentos::class, 'FK_TBL_Actividad_Id', 'PK_CTVD_IdActividad');
    }
}
