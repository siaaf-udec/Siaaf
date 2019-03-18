<?php

namespace App\Container\Gesap\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Funciones extends Model
{
    
    protected $connection = 'gesap';

    protected $table = 'TBL_Requerimientos_Funciones';

    protected $primaryKey = 'PK_Id_Funcion';

    protected $fillable = [
        'MCT_Funcion_Nombre',
        'MCT_Funcion_Funcion',
        'FK_NPRY_IdMctr008'
    ];

      
}