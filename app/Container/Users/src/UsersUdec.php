<?php

namespace App\Container\Users\src;

use App\Container\AdminRegist\Src\Registros;
use Illuminate\Database\Eloquent\Model;
use App\Container\Administrative\Src\RegistroIngreso;
use App\Container\Carpark\src\Motos;
use App\Container\Carpark\src\Usuarios;

class UsersUdec extends Model
{
    protected $connection = 'developer';
    protected $table = 'users_udec';
    protected $primaryKey = 'number_document';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number_document','code', 'username', 'lastname', 'type_user', 'company', 'place', 'number_phone', 'email'
    ];

    //relationships one to many
    public function registroIngreso(){
        return $this->hasMany(RegistroIngreso::class,'id_registro');
    }

    //relationships one to many
    public function registroAdminRegist(){
        return $this->hasMany(Registros::class,'id_registro');
    }

    /**
     * Get the UsuarioEspaciosAcademicos record associated with the user.
     */
    public function acadspace()
    {
        return $this->hasMany('App\Container\Acadspace\Src\Solicitud', 'SOL_id_docente');
    }

    public function formatosAcadspace()
    {
        return $this->hasMany('App\Container\Acadspace\Src\Formatos', 'FK_FAC_id_secretaria');
    }

    //Función de conexión entre las tablas de Usuarios y Motos por el campo de FK_CM_CodigoUser y PK_CU_Codigo para realizar las busquedas complementarias
    public function relacionUsuariosMotos()
    {
        return $this->hasMany(Motos::class, 'FK_CM_CodigoUser');
    }


    //Función de conexión entre las tablas de UsuariosUdec y Usuarios por el campo de PK_CU_Codigo y number_document para realizar las busquedas complementarias de datos de usuario
    public function relacionUsersUdecUsuarios()
    {
        return $this->hasOne(Usuarios::class, 'CU_Cedula','number_document');
    }



}