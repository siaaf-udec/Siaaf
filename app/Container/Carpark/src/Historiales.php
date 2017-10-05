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
        'FK_CH_Ingreso',
        'FK_CH_IdMoto',
        'CH_Placa',
        'CH_FHentrada',
        'CH_FHsalida',
    ];
}
