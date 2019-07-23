<?php

namespace App\Container\CalidadPcs\src;

use Illuminate\Database\Eloquent\Model;

class ProcesoCronograma extends Model
{
    protected $connection = 'calidadpcs';

    protected $table = 'tbl_calidadpcs_proceso_cronograma';

    protected $primaryKey = 'PK_CPP_Id_Proy_Pro';

    protected $fillable = [
        'PK_CPC_Id_Actividad',
        'CPC_Nombre_Actividad',
        'CPC_Fecha_Inicio',
        'CPC_Fecha_Final',
        'CPC_Recursos',
        'FK_CPP_Id_Proyecto',
        'FK_CPP_Id_Proceso',
    ];
}
