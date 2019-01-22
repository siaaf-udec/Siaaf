<?php

namespace App\Container\Gesap\src;

use Illuminate\Database\Eloquent\Model;

class Fechas extends Model
{
    protected $connection = 'gesap';

    protected $table = 'tbl_fechas_radicacion';

    protected $primaryKey = 'PK_Id_Radicacion';

    protected $fillable = [
        'FCH_Radicacion_principal',
        'FCH_Radicacion_secundaria',
    ];

    //Relacion del Estado con el Usuario
   
}