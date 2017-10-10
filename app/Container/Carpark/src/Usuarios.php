<?php

namespace App\Container\Carpark\src;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    protected $connection = 'carpark';

    protected $table = 'TBL_Carpark_usuarios';

    protected $primaryKey = 'PK_CU_Codigo';

    protected $fillable = [
        'PK_CU_Codigo'
        , 'CU_Cedula'
        , 'CU_Nombre1'
        , 'CU_Nombre2'
        , 'CU_Apellido1'
        , 'CU_Apellido2'
        , 'CU_Telefono'
        , 'CU_Correo'
        , 'CU_Direccion'
        , 'CU_UrlFoto'
        , 'FK_CU_IdEstado'
        , 'FK_CU_IdDependencia',
    ];

    public function relacionUsuariosDependencia()
    {
        return $this->hasOne(Dependencias::class, 'PK_CD_IdDependencia', 'FK_CU_IdDependencia');
    }

    public function relacionUsuariosEstado()
    {
        return $this->hasOne(Estados::class, 'PK_CE_IdEstados', 'FK_CU_IdEstado');
    }
    public function relacionUsuariosMotos()
    {
        return $this->hasMany(Motos::class, 'FK_CM_CodigoUser', 'PK_CU_Codigo');
    }

    

}
