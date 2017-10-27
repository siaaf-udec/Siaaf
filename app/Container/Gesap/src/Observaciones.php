<?php

namespace App\container\gesap\src;

use Illuminate\Database\Eloquent\Model;

class Observaciones extends Model
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
    protected $table = 'TBL_Observaciones';

    /**
     * Nombre de columna primary_key de tabla .
     *
     * @var string
     */
    protected $primaryKey = 'PK_BVCS_IdObservacion';

    /**
     * Atributos que son asignables.
     *
     * @var array
     */
    protected $fillable = ['BVCS_Observacion','FK_TBL_Encargado_Id'];
    
    
	/*
	*Función de relacion entre las tablas de Observaciones y Encargados 
	*por los campo de FK_TBL_Encargado_Id y PK_NCRD_IdCargo 
	*seleccionando los campos PK_NCRD_IdCargo, FK_TBL_Anteproyecto_Id, FK_Developer_User_Id, NCRD_Cargo
	*y utilizando la funcion de relacion de usuarios para obtener el nombre del encargado de la observacion
	*para realizar las busquedas complementarias
	*/
    public function encargado()
    {
        return $this->belongsTo(Encargados::class, 'FK_TBL_Encargado_Id', 'PK_NCRD_IdCargo')
            ->select("PK_NCRD_IdCargo", "FK_TBL_Anteproyecto_Id", "FK_Developer_User_Id", "NCRD_Cargo")
            ->with(['usuarios'=>function ($usuarios) {
                            $usuarios->select('name', 'lastname', 'id');
            }]);
    }
	
	/*
	*Función de relacion entre las tablas de Observaciones y respuesta 
	*por los campo de FK_TBL_Observaciones_Id y PK_BVCS_IdObservacion 
	*seleccionando los campos PK_RPST_IdMinr008, RPST_RMin, RPST_Requerimientos, FK_TBL_Observaciones_Id
	*para realizar las busquedas complementarias
	*/
    public function respuesta()
    {
        return $this->hasOne(Respuesta::class, 'FK_TBL_Observaciones_Id', 'PK_BVCS_IdObservacion')
            ->select("PK_RPST_IdMinr008", "RPST_RMin", "RPST_Requerimientos", "FK_TBL_Observaciones_Id");
    }
	
	/*
	*Función de relacion entre las tablas de Observaciones y checkObservaciones 
	*por los campo de FK_TBL_Observaciones_Id y PK_BVCS_IdObservacion 
	*para realizar las busquedas complementarias
	*/
    public function checkObservaciones()
    {
        return $this->hasOne(checkObservaciones::class, 'FK_TBL_Observaciones_Id', 'PK_BVCS_IdObservacion');
    }
}
