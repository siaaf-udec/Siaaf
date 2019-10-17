<?php

namespace App\Container\CalidadPcs\src;

use Illuminate\Database\Eloquent\Model;

class Proceso_Gestionar_Comunicaciones extends Model
{
    protected $connection = 'calidadpcs';

    protected $table = 'TBL_Calidadpcs_proceso_comunicaciones';

    protected $primaryKey = 'PK_CPC_Id_Comunicaciones';

    protected $fillable = [
        'CPC_Medio',
        'CPC_Redaccion',
        'FK_CPC_Id_Proyecto',
    ];

}