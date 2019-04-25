<?php

namespace App\Container\CalidadPcs\src;

use Illuminate\Database\Eloquent\Model;

class EquipoScrum extends Model
{
    protected $connection = 'calidadpcs';

    protected $table = 'TBL_Calidadpcs_equipo_scrum';

    protected $primaryKey = 'PK_CE_Id_Equipo_Scrum';

    protected $fillable = [
        'PK_CE_Id_Equipo_Scrum',
        'CE_Nombre_Persona',
        'FK_CE_Id_Rol',
        'FK_CE_Id_Proyecto',
    ];
}