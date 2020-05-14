<?php

namespace App\Container\CalidadPcs\src;

use Illuminate\Database\Eloquent\Model;

class Proceso_Adquisiciones extends Model
{
    protected $connection = 'calidadpcs';

    protected $table = 'TBL_Calidadpcs_proceso_adquisiciones';

    protected $primaryKey = 'PK_CPGA_Id_Adquisicion';

    protected $fillable = [
        'CPGA_Adquisicion',
        'CPGA_Costo',
        'CPGA_Duracion',
        'CPGA_Proveedor',
        'CPGA_Tipo_Contrato',
        'CPGA_Estado',
        'FK_CPC_Id_Proyecto',
    ];

}