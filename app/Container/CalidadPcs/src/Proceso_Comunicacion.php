<?php

namespace App\Container\CalidadPcs\src;

use Illuminate\Database\Eloquent\Model;

class Proceso_Comunicacion extends Model
{
    protected $connection = 'calidadpcs';

    protected $table = 'TBL_Calidadpcs_proceso_comunicacion';

    protected $primaryKey = 'PK_CPGC_Id_Comunicacion';

    protected $fillable = [
        // 'PK_CPC_Id_Costo',
        'CPGC_Interesado',
        'CPGC_Lugar',
        'CPGC_Fecha',
        'FK_CPC_Id_Proyecto',
    ];

}