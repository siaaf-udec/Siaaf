<?php

namespace App\Container\Carpark\src;

use Illuminate\Database\Eloquent\Model;
use App\Container\Users\src\UsersUdec;

class Motos extends Model
{
    protected $connection = 'carpark';

    protected $table = 'TBL_Carpark_Motos';

    protected $primaryKey = 'PK_CM_IdMoto';

    protected $fillable = [
        'PK_CM_IdMoto',
        'CM_Placa',
        'CM_Marca',
        'CM_NuPropiedad',
        'CM_NuSoat',
        'CM_FechaSoat',
        'CM_UrlFoto',
        'CM_UrlPropiedad',
        'CM_UrlSoat',
        'FK_CM_CodigoUser',
    ];

    //Función de conexión entre las tablas de Motos y Usuarios por el campo de PK_CU_Codigo y FK_CM_CodigoUser para realizar las busquedas complementarias
    public function relacionMotosUsuarios()
    {
        return $this->belongsTo(UsersUdec::class, 'FK_CM_CodigoUser');
    }
}
