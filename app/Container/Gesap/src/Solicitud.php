<?php

namespace App\Container\Gesap\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Solicitud extends Model
{
    
    protected $connection = 'gesap';

    protected $table = 'TBL_Solicitud';

    protected $primaryKey = 'Pk_Id_Solicitud';

    protected $fillable = [
        'Sol_Solicitud',
        'FK_NPRY_IdMctr008'
    ];
    
}