<?php

namespace App\Container\Carpark\src;

use Illuminate\Database\Eloquent\Model;

class Ingresos extends Model
{
    protected $connection = 'carpark';

    protected $table = 'TBL_Carpark_ingresos';

    protected $primaryKey = 'PK_CI_IdIngreso';

    protected $fillable = [
    	'PK_CI_IdIngreso',
        'CI_NombresUser',
        'CI_CodigoUser',
        'CI_Placa',
        'CI_CodigoMoto'];

    public function FuncionIngresos()
    {
        return $this->belongsTo(Usuarios::class, 'CI_CodigoUser', 'PK_CU_Codigo');
    }
}
