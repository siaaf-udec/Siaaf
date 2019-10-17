<?php

namespace App\Container\CalidadPcs\src;

use Illuminate\Database\Eloquent\Model;

class Proceso_Aseguramiento extends Model
{
    protected $connection = 'calidadpcs';

    protected $table = 'TBL_Calidadpcs_proceso_aseguramiento';

    protected $primaryKey = 'PK_CPA_Id_Aseguramiento';

    protected $fillable = [
        'CPA_Aseguramiento',
        'FK_CPC_Id_Proyecto',
    ];

}