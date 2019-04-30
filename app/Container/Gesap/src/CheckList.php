<?php

namespace App\Container\Gesap\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Checklist extends Model
{   
    //este modelo es para el estado de la actividad APROBADO// EN CALIFICACIÓN
    
    protected $connection = 'gesap';

    protected $table = 'TBL_Checklist';

    protected $primaryKey = 'PK_CHK_Checklist';

    protected $fillable = [
        'CHK_Checlist'
        ,'CHK_Checlist_Data'
        
    ];
    
}