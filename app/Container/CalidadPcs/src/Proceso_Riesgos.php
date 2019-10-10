<?php

namespace App\Container\CalidadPcs\src;

use Illuminate\Database\Eloquent\Model;

class Proceso_Riesgos extends Model
{
    protected $connection = 'calidadpcs';

    protected $table = 'TBL_Calidadpcs_proceso_riesgos';

    protected $primaryKey = 'PK_CPGR_Id_Riesgo';

    protected $fillable = [
        'CPGR_Riesgo',
        'CPGR_Caracteristicas',
        'CPGR_Importancia',
        'CPGR_Accion',
        'FK_CPC_Id_Proyecto',
    ];

}