<?php

namespace App\Container\Gesap\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class NoFunciones extends Model
{
    //modelo del mct para la tabla funciones (requerimientos No Funcionales)
    protected $connection = 'gesap';

    protected $table = 'TBL_Requerimientos_No_Funciones';

    protected $primaryKey = 'PK_Id_No_Funcion';

    protected $fillable = [
        'MCT_No_Funcion_Nombre',
        'MCT_No_Funcion_Funcion',
        'FK_NPRY_IdMctr008'
    ];

      
}