<?php

namespace App\Container\CalidadPcs\src;

use Illuminate\Database\Eloquent\Model;

class ProcesoCronograma extends Model
{
    protected $connection = 'calidadpcs';

    protected $table = 'tbl_calidadpcs_proceso_cronograma';

    protected $primaryKey = 'PK_CPC_Id_Sprint';

    protected $fillable = [
        'CPC_Nombre_Sprint',
        'CPC_Requerimiento',
        'CPC_Duracion',
        'CPC_Recurso',
        'CPC_Entregable',
        'CPC_Estado',
        'FK_CPP_Id_Proyecto',
    ];
}
