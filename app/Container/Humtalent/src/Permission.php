<?php

namespace App\Container\Humtalent\src;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

    protected $connection = 'humtalent';

    protected $table = 'TBL_Permiso';

    protected $primaryKey = 'PK_PERM_IdPermiso';

    protected $fillable = [
        'PERM_Fecha', 'PERM_Descripcion', 'FK_TBL_Persona_Cedula',
    ];

    public function Personas()
    {
        return $this->belongsTo(Persona::class);
    }
    //
}
