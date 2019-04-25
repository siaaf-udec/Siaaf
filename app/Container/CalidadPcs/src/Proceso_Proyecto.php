<?php

namespace App\Container\CalidadPcs\src;

use Illuminate\Database\Eloquent\Model;

class Proceso_Proyecto extends Model
{
    protected $connection = 'calidadpcs';

    protected $table = 'TBL_Calidadpcs_proyecto_proceso';

    protected $primaryKey = 'PK_CPP_Id_Proy_Pro';

    protected $fillable = [
        'PK_CPP_Id_Proy_Pro',
        'CPP_Info_Proceso',
        'FK_CPP_Id_Proyecto',
        'FK_CPP_Id_Proceso',
    ];
}
