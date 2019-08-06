<?php

namespace App\Container\CalidadPcs\src;

use Illuminate\Database\Eloquent\Model;

class Proceso_Requerimientos extends Model
{
    protected $connection = 'calidadpcs';

    protected $table = 'tbl_calidadpcs_proceso_requerimientos';

    protected $primaryKey = 'PK_CPR_Id_Requerimientos';

    protected $fillable = [
        'CPR_Nombre_Requerimiento',
        'FK_CPR_Id_Proyecto',
        'FK_CPR_Id_Proceso',
    ];
}
