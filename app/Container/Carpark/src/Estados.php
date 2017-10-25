<?php

namespace App\Container\Carpark\src;

use Illuminate\Database\Eloquent\Model;

class Estados extends Model
{
    protected $connection = 'carpark';

    protected $table = 'TBL_Carpark_Estados';

    protected $primaryKey = 'PK_CE_IdEstados';

    protected $fillable = [
        'PK_CE_IdEstados',
        'CE_Estados',
    ];
}
