<?php

namespace App\Container\CalidadPcs\src;

use Illuminate\Database\Eloquent\Model;

class Costos_Informacion extends Model
{
    protected $connection = 'calidadpcs';

    protected $table = 'TBL_Calidadpcs_proceso_costos_informacion';

    protected $primaryKey = 'PK_CPCI_Id_Costos';

    protected $fillable = [
        'CPCI_Abreviatura',
        'CPCI_Nombre',
        'CPCI_Definicion',
        'CPCI_Uso',
        'CPCI_Formula',
        'CPCI_Interpretacion',
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