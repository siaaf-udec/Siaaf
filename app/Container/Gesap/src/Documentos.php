<?php

namespace App\container\gesap\src;

use Illuminate\Database\Eloquent\Model;

class Documentos extends Model
{
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
    protected $table = 'TBL_Documentos';

    /**
     * Nombre de columna primary_key de tabla .
     *
     * @var string
     */
    protected $primaryKey = 'PK_DMNT_IdProyecto';

    /**
     * Atributos que son asignables.
     *
     * @var array
     */
    protected $fillable = ['FK_TBL_Actividad_Id','DMNT_Archivo','FK_TBL_Proyecto_Id'];

    /*
	*Función de relacion entre las tablas de Documentos y proyecto 
	*por los campo de FK_TBL_Proyecto_Id y PK_PRYT_IdProyecto 
	*para realizar las busquedas complementarias
	*/
    public function proyecto()
    {
        return $this->belongsto(Proyecto::class, 'FK_TBL_Proyecto_Id', 'PK_PRYT_IdProyecto');
    }

    /*
	*Función de relacion entre las tablas de Documentos y actividades 
	*por los campo de FK_TBL_Actividad_Id y PK_PRYT_IdProyecto 
	*para realizar las busquedas complementarias
	*/
    public function actividad()
    {
        return $this->belongsto(Actividad::class, 'FK_TBL_Actividad_Id', 'PK_CTVD_IdActividad')->withTrashed();
    }
}
