<?php

namespace App\Container\CalidadPcs\src;

use Illuminate\Database\Eloquent\Model;

class Rol_Scrum extends Model
{
    protected $connection = 'calidadpcs';

    protected $table = 'TBL_Calidadpcs_rol_scrum';

    protected $primaryKey = 'PK_CR_Id_Rol_Scrum';

    protected $fillable = [
        'PK_CR_Id_Rol_Scrum',
        'CR_Nombre_Rol_Scrum',
    ];
}
