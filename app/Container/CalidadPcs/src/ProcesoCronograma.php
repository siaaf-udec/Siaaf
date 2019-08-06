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
        'CPC_Recurso',
        'FK_CPP_Id_Proyecto',
    ];
}
