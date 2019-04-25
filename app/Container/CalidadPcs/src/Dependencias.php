<?php

namespace App\Container\CalidadPcs\src;

use Illuminate\Database\Eloquent\Model;

class Dependencias extends Model
{
    protected $connection = 'calidadpcs';

    protected $table = 'TBL_Calidadpcs_Dependencias';

    protected $primaryKey = 'PK_CD_Id_Dependencia';

    protected $fillable = [
        'PK_CD_Id_Dependencia',
        'CD_Dependencia',
    ];

    //Función de conexión entre las tablas de dependencia y usuario por el campo de PK_CD_IdDependencia y FK_CU_IdDependencia para realizar las busquedas complementarias
    public function relacionDependenciaUsuario()
    {
        return $this->belongsTo(Usuarios::class,
            'PK_CD_Id_Dependencia',
            'FK_CU_Id_Dependencia'
        );
    }
}
