<?php

namespace App\Container\CalidadPcs\src;

use Illuminate\Database\Eloquent\Model;

class Proceso_Participacion extends Model
{
    protected $connection = 'calidadpcs';

    protected $table = 'TBL_Calidadpcs_proceso_interesados';

    protected $primaryKey = 'PK_CPI_Id_Interesados';

    protected $fillable = [
        'CPI_Necesidades',
        'CPI_Expectativas',
        'CPI_Participacion',
        'CPI_Observaciones',
        'FK_CPC_Id_Proyecto',
    ];

}