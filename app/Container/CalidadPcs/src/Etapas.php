<?php

namespace App\Container\CalidadPcs\src;

use Illuminate\Database\Eloquent\Model;

class Etapas extends Model
{
    protected $connection = 'calidadpcs';

    protected $table = 'TBL_Calidadpcs_etapa';

    protected $primaryKey = 'PK_CE_Id_Etapa';

    protected $fillable = [
        'PK_CE_Id_Etapa',
        'CE_Etapa',
    ];
}
