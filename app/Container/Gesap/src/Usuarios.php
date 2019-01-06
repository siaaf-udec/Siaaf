<?php

namespace App\Container\Gesap\src;

use Illuminate\Database\Eloquent\Model;
use App\Container\Users\src\UsersUdec;

class Usuarios extends Model
{
    protected $connection = 'gesap';

    protected $table = 'TBL_Usuario';

    protected $primaryKey = 'PK_User_Codigo';

    protected $fillable = [
        'PK_User_Codigo'
        , 'User_Cedula'
        , 'User_Nombre1'
        , 'User_Nombre2'
        , 'User_Apellido1'
        , 'User_Apellido2'
        , 'User_Correo'
        , 'User_Contra'
        , 'User_Direccion'
        , 'FK_User_IdEstado'
        , 'FK_User_IdRol',
    ];    

    //Relacion entre Usuarios y Rol
    public function relacionUsuariosRol()
    {
        return $this->hasMany(RolesUsuario::class, 'PK_Id_Rol_Usuario','FK_User_IdRol');
    }

    //Relacion entre Usuarios y Estado
    public function relacionUsuariosEstado()
    {
        return $this->hasOne(Estados::class, 'PK_IdEstado', 'FK_User_IdEstado');
    }
}
