<?php

namespace App\Container\Humtalent\src;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    /**
     * Conexión de la base de datos usada por el modelo
     *
     * @var string
     */
    protected $connection = 'humtalent';

    /**
     * Tabla utilizada por el modelo.
     *
     * @var string
     */
    protected $table = 'TBL_Personas';

    /**
     * Llave utilizada por el modelo.
     *
     * @var string
     */
    protected $primaryKey = 'PK_PRSN_Cedula';

    /**
     * Atributos que son asignables.
     *
     * @var array
     */
    protected $fillable = [

        'PK_PRSN_Cedula', 'PRSN_Rol', 'PRSN_Nombres', 'PRSN_Apellidos', 'PRSN_Telefono', 'PRSN_Correo', 'PRSN_Direccion',
        'PRSN_Ciudad', 'PRSN_Salario', 'PRSN_Eps', 'PRSN_Fpensiones', 'PRSN_Area', 'PRSN_Caja_Compensacion', 'PRSN_Estado_Persona',
    ];


    /**
     *  Función que retorna la relación entre la tabla 'tbl_personas' y la tabla 'tbl_asistentes'
     *  a través de la llave foránea 'FK_TBL_Persona_Cedula'
     */
    public function asistents()
    {
        return $this->hasMany(Asistent::class, 'FK_TBL_Persona_Cedula');
    }

    /**
     *  Función que retorna la relación entre la tabla 'tbl_personas' y la tabla 'tbl_estado_documentacion'
     *  a través de la llave foránea 'FK_TBL_Persona_Cedula'
     */
    public function statusOfDocuments()
    {
        return $this->hasMany(StatusOfDocument::class, 'FK_TBL_Persona_Cedula');
    }

    /**
     *  Función que retorna la relación entre la tabla 'tbl_personas' y la tabla 'tbl_inducciones'
     */
    public function inductions()
    {
        return $this->hasMany(Induction::class);
    }

    /**
     *  Función que retorna la relación entre la tabla 'tbl_personas' y la tabla 'tbl_permiso'
     */
    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }
}
