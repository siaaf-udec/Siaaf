<?php

namespace App\Container\Humtalent\src;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * The database connection used by the model.
     *
     * @var string
     */
    protected $connection = 'humtalent';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'TBL_Permiso';

    /**
     * The database key used by the model.
     *
     * @var string
     */
    protected $primaryKey = 'PK_PERM_IdPermiso';

    /**
     * The attributes that are mass assignable.
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
