<?php

namespace App\Container\CalidadPcs\src;

use Illuminate\Database\Eloquent\Model;

class Proceso_Direccion extends Model
{
    protected $connection = 'calidadpcs';

    protected $table = 'TBL_Calidadpcs_proceso_direccion';

    protected $primaryKey = 'PK_CPPD_Id_Direccion';

    protected $fillable = [
        'CPPD_Alcance',
        'CPPD_Metodologia',
        'FK_CPC_Id_Proyecto',
    ];

}