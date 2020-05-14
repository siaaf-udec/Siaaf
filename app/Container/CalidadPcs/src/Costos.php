<?php

namespace App\Container\CalidadPcs\src;

use Illuminate\Database\Eloquent\Model;

class Costos extends Model
{
    protected $connection = 'calidadpcs';

    protected $table = 'TBL_Calidadpcs_proceso_costos';

    protected $primaryKey = 'PK_CPC_Id_Costo';

    protected $fillable = [
        'CPC_Valor',
        'CPC_Estado',
        'FK_CPC_Id_Formula',
        'FK_CPC_Id_Proyecto',
    ];

}