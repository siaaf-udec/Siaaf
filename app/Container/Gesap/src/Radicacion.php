<?php

namespace App\container\gesap\src;

use Illuminate\Database\Eloquent\Model;

class Radicacion extends Model
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
    protected $table = 'TBL_Radicacion';

    /**
     * Nombre de columna primary_key de tabla .
     *
     * @var string
     */
    protected $primaryKey = 'PK_RDCN_IdRadicacion';

    /**
     * Atributos que son asignables.
     *
     * @var array
     */
    protected $fillable = ['RDCN_Min','RDCN_Requerimientos','FK_TBL_Anteproyecto_Id'];

    /*	
	*Función de relacion entre las tablas de Radicacion y Anteproyecto 
	*por los campo de FK_TBL_Anteproyecto_Id y PK_NPRY_IdMinr008 
	*para realizar las busquedas complementarias
	*/
    public function anteproyecto()
    {
        return $this->belongsto(Anteproyecto::class, 'FK_TBL_Anteproyecto_Id', 'PK_NPRY_IdMinr008');
    }
}
