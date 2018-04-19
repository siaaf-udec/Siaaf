<?php

namespace App\container\gesap\src;

use Illuminate\Database\Eloquent\Model;

class Conceptos extends Model
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
    protected $table = 'TBL_Conceptos';

    /**
     * Nombre de columna primary_key de tabla .
     *
     * @var string
     */
    protected $primaryKey = 'PK_CNPT_Conceptos';

    /**
     * Atributos que son asignables.
     *
     * @var array
     */
    protected $fillable = ['CNPT_Concepto', 'CNPT_Tipo', 'FK_TBL_Encargado_Id'];

    /*
	*Función de relacion entre las tablas de Conceptos y Encargados 
	*por los campo de FK_TBL_Encargado_Id y PK_NCRD_IdCargo 
	*seleccionando los campos PK_NCRD_IdCargo, FK_TBL_Anteproyecto_Id, FK_Developer_User_Id, NCRD_Cargo
	*y utilizando la funcion de relacion de usuarios para obtener el nombre del encargado de la observacion
	*para realizar las busquedas complementarias
	*/
    public function encargado()
    {
        return $this->belongsTo(Encargados::class, 'FK_TBL_Encargado_Id', 'PK_NCRD_IdCargo')
            ->select("PK_NCRD_IdCargo", "FK_TBL_Anteproyecto_Id", "FK_Developer_User_Id", "NCRD_Cargo")
            ->with(['usuarios' => function ($usuarios) {
                $usuarios->select('name', 'lastname', 'id');
            }]);
    }

}
