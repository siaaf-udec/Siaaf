<?php

namespace App\Container\Carpark\src;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    protected $connection = 'carpark';

    protected $table = 'TBL_Carpark_Usuarios';

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

    //Función de conexión entre las tablas de Usuarios y Dependencias por el campo de PK_CD_IdDependencia y FK_CU_IdDependencia para realizar las busquedas complementarias
    public function relacionUsuariosDependencia()
    {
        return $this->hasOne(Dependencias::class, 'PK_CD_IdDependencia', 'FK_CU_IdDependencia');
    }

    //Función de conexión entre las tablas de Usuarios y Estados por el campo de PK_CE_IdEstados y FK_CU_IdEstado para realizar las busquedas complementarias
    public function relacionUsuariosEstado()
    {
        return $this->hasOne(Estados::class, 'PK_CE_IdEstados', 'FK_CU_IdEstado');
    }

    //Función de conexión entre las tablas de Usuarios y Motos por el campo de FK_CM_CodigoUser y PK_CU_Codigo para realizar las busquedas complementarias
    
    public function relacionUsuariosMotos()
    {
        return $this->hasMany(Motos::class, 'FK_CM_CodigoUser', 'PK_CU_Codigo');
    }

    


}
