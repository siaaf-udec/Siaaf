<?php

namespace App\Container\Carpark\src;

use Illuminate\Database\Eloquent\Model;

class Motos extends Model
{
    protected $connection = 'carpark';

    protected $table = 'TBL_Carpark_motos';

    protected $primaryKey = 'PK_CM_IdMoto';

    protected $fillable = [
        'PK_CM_IdMoto',
        'CM_Placa',
        'CM_Marca',
        'CM_NuPropiedad',
        'CM_NuSoat',
        'CM_fechaSoat',
        'CM_UrlFoto',
        'CM_UrlPropiedad',
        'CM_UrlSoat',
        'FK_CM_CodigoUser',
    ];

    public function relacionMotosUsuarios()
    {
        return $this->hasMany(Usuarios::class, 'PK_CU_Codigo', 'FK_CM_CodigoUser');
    }
}
