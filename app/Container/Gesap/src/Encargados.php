<?php

namespace App\Container\gesap\src;

use Illuminate\Database\Eloquent\Model;

class Encargados extends Model
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
    protected $table = 'TBL_Encargados';

    /**
     * Nombre de columna primary_key de tabla .
     *
     * @var string
     */
    protected $primaryKey = 'PK_NCRD_IdCargo';

    /**
     * Atributos que son asignables.
     *
     * @var array
     */
    protected $fillable = ['FK_TBL_Anteproyecto_Id', 'FK_Developer_User_Id', 'NCRD_Cargo'];


    /*
	*Función de relacion entre las tablas de Encargados y anteproyecto 
	*por los campo de FK_TBL_Anteproyecto_Id y PK_NPRY_IdMinr008 
	*para realizar las busquedas complementarias
	*/
    public function anteproyecto()
    {
        return $this->belongsTo(Anteproyecto::class, 'FK_TBL_Anteproyecto_Id', 'PK_NPRY_IdMinr008');
    }

    /*
	*Función de relacion entre las tablas de Encargados y observaciones 
	*por los campo de FK_TBL_Encargado_Id y PK_NCRD_IdCargo 
	*para realizar las busquedas complementarias
	*/
    public function observaciones()
    {
        return $this->hasMany(Observaciones::class, 'FK_TBL_Encargado_Id', 'PK_NCRD_IdCargo');
    }

    /*
	*Función de relacion entre las tablas de Encargados y conceptos 
	*por los campo de FK_TBL_Encargado_Id y PK_NCRD_IdCargo 
	*para realizar las busquedas complementarias
	*/
    public function conceptos()
    {
        return $this->hasOne(Conceptos::class, 'FK_TBL_Encargado_Id', 'PK_NCRD_IdCargo');
    }

    /*
	*Función de relacion entre las tablas de Encargados y usuarios 
	*por los campo de FK_Developer_User_Id y id 
	*para realizar las busquedas complementarias
	*/
    public function usuarios()
    {
        return $this->belongsTo('App\container\Users\src\User', 'FK_Developer_User_Id', 'id');
    }
}
