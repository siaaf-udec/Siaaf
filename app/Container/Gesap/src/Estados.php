<?php

namespace App\Container\Gesap\src;

use Illuminate\Database\Eloquent\Model;

class Estados extends Model
{
    protected $connection = 'gesap';

    protected $table = 'TBL_Estados';

    protected $primaryKey = 'PK_IdEstado';

    protected $fillable = [
        'PK_IdEstado',
        'STD_Descripcion',
    ];
}
