<?php

namespace App\Container\Acadspace\src;

use DB;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Calendario extends Model
{
    protected $connection = 'acadspace';

    protected $table = 'TBL_Calendario';

    protected $primaryKey = 'PK_CAL_Id';

    protected $fillable = [
        'CAL_Fecha_Ini',
        'CAL_Fecha_Fin',
        'CAL_Color',
        'CAL_Titulo',
        'CAL_Sala'
    ];
    // 
}