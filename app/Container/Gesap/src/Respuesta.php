<?php

namespace App\container\gesap\src;

use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
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
    protected $table = 'TBL_Respuesta';

    /**
     * Nombre de columna primary_key de tabla .
     *
     * @var string
     */
    protected $primaryKey = 'PK_RPST_IdMinr008';

    /**
     * Atributos que son asignables.
     *
     * @var array
     */
    protected $fillable = ['RPST_RMin','RPST_Requerimientos','FK_TBL_Radicacion_Id'];

    /*	
	*Función de relacion entre las tablas de Respuesta y Observaciones 
	*por los campo de FK_TBL_Observaciones_Id y PK_BVCS_IdObservacion 
	*para realizar las busquedas complementarias
	*/
    public function observaciones()
    {
        return $this->belongsto(Observaciones::class, 'FK_TBL_Observaciones_Id', 'PK_BVCS_IdObservacion');
    }
}
