<?php

namespace App\Container\CalidadPcs\src;

use Illuminate\Database\Eloquent\Model;
use App\Container\Users\src\UsersUdec;

class Usuarios extends Model
{
    protected $connection = 'calidadpcs';

    protected $table = 'TBL_Calidadpcs_Usuarios';

    protected $primaryKey = 'PK_CU_Id_Usuario';

    protected $fillable = [
        'PK_CU_Id_Usuario'
        , 'CU_Cedula'
        , 'CU_Nombre'
        , 'CU_Apellido'
        , 'CU_Telefono'
        , 'CU_Correo',
    ];

    //Función de conexión entre las tablas de Usuarios y Motos por el campo de FK_CM_CodigoUser y PK_CU_Codigo para realizar las busquedas complementarias
    public function relacionUsuariosProyectos()
    {
        return $this->hasMany(Proyectos::class, 'FK_CP_Id_Usuario', 'PK_CU_Id_Usuario');
    }

    //Función de conexión entre las tablas de UsuariosUdec y Usuarios por el campo de PK_CU_Codigo y number_document para realizar las busquedas complementarias de datos de usuario
    public function relacionUsersUdecUsuarios()
    {
        return $this->hasOne(UsersUdec::class, 'number_document','CU_Cedula');
    }      

}
