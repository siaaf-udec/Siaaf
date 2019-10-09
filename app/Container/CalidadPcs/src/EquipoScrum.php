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

    //Función de conexión entre las tablas de dependencia y usuario por el campo de PK_CD_IdDependencia y FK_CU_IdDependencia para realizar las busquedas complementarias
    public function relacionDependenciaUsuario()
    {
        return $this->belongsTo(
            Rol_Scrum::class,
            'FK_CE_Id_Rol',
            'PK_CR_Id_Rol_Scrum'

        );
    }
}
