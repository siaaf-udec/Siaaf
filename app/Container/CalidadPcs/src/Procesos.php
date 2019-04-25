<?php

namespace App\Container\CalidadPcs\src;

use Illuminate\Database\Eloquent\Model;

class Procesos extends Model
{
    protected $connection = 'calidadpcs';

    protected $table = 'TBL_Calidadpcs_procesos';

    protected $primaryKey = 'PK_CP_Id_Proceso';

    protected $fillable = [
        'PK_CP_Id_Proceso',
        'CP_Nombre_Proceso',
        'CP_Tipo_Parseo',
        'FK_CP_Id_Etapa',
    ];
}
