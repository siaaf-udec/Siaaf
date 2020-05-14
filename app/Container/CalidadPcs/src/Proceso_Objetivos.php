<?php

namespace App\Container\CalidadPcs\src;

use Illuminate\Database\Eloquent\Model;

class Proceso_Objetivos extends Model
{
    protected $connection = 'calidadpcs';

    protected $table = 'TBL_Calidadpcs_Objetivos';

    protected $primaryKey = 'PK_CO_Id_Objetivo';

    protected $fillable = [
        'CO_Objetivo',
        'CO_Tipo_Objetivo',
        'CO_Estado',
        'FK_CPC_Id_Proyecto',
    ];

}