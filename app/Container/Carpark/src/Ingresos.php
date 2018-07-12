<?php

namespace App\Container\Carpark\src;

use Illuminate\Database\Eloquent\Model;
use App\Container\Users\src\UsersUdec;
use App\Container\Carpark\src\Usuarios;

class Ingresos extends Model
{
    protected $connection = 'carpark';

    protected $table = 'TBL_Carpark_Ingresos';

    protected $primaryKey = 'PK_CI_IdIngreso';

    protected $fillable = [
        'PK_CI_IdIngreso',
        'CI_NombresUser',
        'CI_CodigoUser',
        'CI_Placa',
        'CI_CodigoMoto'];

    //Función de conexión entre las tablas de Ingresos y Usuarios por el campo de CI_CodigoUser y PK_CU_Codigo para realizar las busquedas complementarias
    // public function relacionIngresosUsuarios()
    // {
    //     return $this->belongsTo(UsersUdec::class, 'CI_CodigoUser');
    // }


     public function relacionIngresosUsuarios()
    {
        //return $this->belongsTo(UsersUdec::class, 'FK_CM_CodigoUser');
        return $this->belongsTo(Usuarios::class, 'CU_Cedula','CI_CodigoUser');
    }
}
