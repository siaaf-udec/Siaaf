<?php

namespace App\container\gesap\src;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
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
    protected $table = 'TBL_Proyecto';

    /**
     * Nombre de columna primary_key de tabla .
     *
     * @var string
     */
    protected $primaryKey = 'PK_PRYT_IdProyecto';

    /**
     * Atributos que son asignables.
     *
     * @var array
     */
    protected $fillable = ['PRYT_Estado','FK_TBL_Anteproyecto_Id'];

    /*	
	*Función de relacion entre las tablas de Proyecto y Anteproyecto 
	*por los campo de FK_TBL_Anteproyecto_Id y PK_NPRY_IdMinr008 
	*para realizar las busquedas complementarias
	*/
    public function anteproyecto()
    {
        return $this->belongsto(Anteproyecto::class, 'FK_TBL_Anteproyecto_Id', 'PK_NPRY_IdMinr008');
    }

    /*	
	*Función de relacion entre las tablas de Proyecto y Documentos 
	*por los campo de FK_TBL_Proyecto_Id y PK_PRYT_IdProyecto 
	*para realizar las busquedas complementarias
	*/
    public function documentos()
    {
        return $this->hasMany(Documentos::class, 'FK_TBL_Proyecto_Id', 'PK_PRYT_IdProyecto');
    }
}
