<?php

namespace App\Container\CalidadPcs\src;

use Illuminate\Database\Eloquent\Model;

class Proceso_Recursos extends Model
{
    protected $connection = 'calidadpcs';

    protected $table = 'TBL_Calidadpcs_proceso_recursos';

    protected $primaryKey = 'PK_CPGR_Id_Gestion';

    protected $fillable = [
        // 'PK_CPC_Id_Costo',
        'CPGR_Funcion',
        'FK_CPGR_Id_Equipo',
        'FK_CPC_Id_Proyecto',
    ];

}