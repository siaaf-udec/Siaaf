<?php

namespace App\Container\Gesap\src;

use Illuminate\Database\Eloquent\Model;

class Fechas extends Model
{
    //en este modelo se guardan las fechas de radicacion para proyecto ya nteproyecto
    protected $connection = 'gesap';

    protected $table = 'TBL_Fechas_Radicacion';

    protected $primaryKey = 'PK_Id_Radicacion';

    protected $fillable = [
        'FCH_Radicacion'
    ];

    
   
}