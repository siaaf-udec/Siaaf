<?php

namespace App\Container\Carpark\src;

use Illuminate\Database\Eloquent\Model;

class Historiales extends Model
{
    protected $connection = 'carpark';

    protected $table = 'TBL_Carpark_historiales';

    protected $primaryKey = 'PK_CH_IdHistoia';

    protected $fillable = [
        'PK_CH_IdHistoia',
        'CH_NombresUser',
        'CH_CodigoUser',
        'CH_Placa',
        'CH_CodigoMoto',
        'CH_FHentrada',
        'CH_FHsalida',
    ];
}
