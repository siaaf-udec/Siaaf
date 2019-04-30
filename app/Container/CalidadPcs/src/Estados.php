<?php

namespace App\Container\CalidadPcs\src;

use Illuminate\Database\Eloquent\Model;

class Estados extends Model
{
    protected $connection = 'calidadpcs';

    protected $table = 'TBL_Calidadpcs_Estados';

    protected $primaryKey = 'PK_CE_Id_Estado';

    protected $fillable = [
        'PK_CE_Id_Estado',
        'CE_Estado',
    ];
}
