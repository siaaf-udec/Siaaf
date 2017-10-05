<?php

namespace App\Container\Carpark\src;

use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    protected $connection = 'carpark';

    protected $table = 'TBL_Carpark_ingresos';

    protected $primaryKey = 'PK_CI_IdIngreso';

    protected $fillable = [
        'PK_CI_IdIngreso',
        'CI_Ingreso',
        'FK_CI_IdMoto'];
}
