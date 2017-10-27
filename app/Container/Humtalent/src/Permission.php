<?php

namespace App\Container\Humtalent\src;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
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
    protected $table = 'TBL_Permiso';

    /**
     * Llave utilizada por el modelo.
     *
     * @var string
     */
    protected $primaryKey = 'PK_PERM_IdPermiso';

    /**
     * Atributos que son asignables.
     *
     * @var array
     */
    protected $fillable = [
        'PERM_Fecha', 'PERM_Descripcion', 'FK_TBL_Persona_Cedula',
    ];

    /**
     *  Función que retorna la relación entre la tabla 'tbl_personas' y la tabla 'tbl_permiso'
     */
    public function personas()
    {
        return $this->belongsTo(Persona::class);
    }

}
