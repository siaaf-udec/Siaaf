<?php

namespace App\Container\Gesap\src;

use Illuminate\Database\Eloquent\Model;

class Fechas extends Model
{
    protected $connection = 'gesap';

    protected $table = 'TBL_fechas_radicacion';

    protected $primaryKey = 'PK_Id_Radicacion';

    protected $fillable = [
        'FCH_Radicacion'
    ];

    //Relacion del Estado con el Usuario
   
}