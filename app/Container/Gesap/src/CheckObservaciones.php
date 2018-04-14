<?php

namespace App\container\gesap\src;

use Illuminate\Database\Eloquent\Model;

class CheckObservaciones extends Model
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
    protected $table = 'TBL_Check_Observaciones';

    /**
     * Nombre de columna primary_key de tabla .
     *
     * @var string
     */
    protected $primaryKey = 'PK_CBSV_Id';

    /**
     * Atributos que son asignables.
     *
     * @var array
     */
    protected $fillable = ['CBSV_Estudiante1','CBSV_Estudiante2','CBSV_Director','FK_TBL_Observaciones_Id'];

    /*
	*Función de relacion entre las tablas de CheckObservaciones y observaciones 
	*por los campo de FK_TBL_Observaciones_Id y PK_BVCS_IdObservacion 
	*para realizar las busquedas complementarias
	*/
    public function observaciones()
    {
        return $this->belongsto(Observaciones::class, 'FK_TBL_Observaciones_Id', 'PK_BVCS_IdObservacion');
    }
}
