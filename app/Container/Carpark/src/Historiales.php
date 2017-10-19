<?php

namespace App\Container\Carpark\src;

use Illuminate\Database\Eloquent\Model;

class Historiales extends Model
{
    protected $connection = 'carpark';

    protected $table = 'TBL_Carpark_Historiales';

    protected $primaryKey = 'PK_CH_IdHistorial';

    protected $fillable = [
        'PK_CH_IdHistorial',
        'CH_NombresUser',
        'CH_CodigoUser',
        'CH_Placa',
        'CH_CodigoMoto',
        'CH_FHentrada',
        'CH_FHsalida',
    ];
}
