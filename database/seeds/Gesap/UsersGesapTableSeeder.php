<?php

use App\Container\Gesap\src\Usuarios;
use \Illuminate\Database\Seeder;
use App\Container\Permissions\src\Role;

class UsersGesapTableSeeder extends Seeder
{
    //dos profesores para asignar anteproyectos y 3 desarrolladores

    public function run()
    {
        Usuarios::insert([
        
        ['PK_User_Codigo'=>'123456789', 'User_Codigo'=>'125478963','User_Nombre1'=>'marta est1','User_Apellido1'=>'luna',
        'User_Correo'=>'l@mail.com','User_Contra'=>'123','User_Direccion'=>'calle 8#111','FK_User_IdEstado'=>'1','FK_User_IdRol'=>'1'],
        ['PK_User_Codigo'=>'123456189', 'User_Codigo'=>'125118963','User_Nombre1'=>'jose est2','User_Apellido1'=>'luna',
        'User_Correo'=>'ll@mail.com','User_Contra'=>'123','User_Direccion'=>'calle 8#111','FK_User_IdEstado'=>'1','FK_User_IdRol'=>'1'],
        ['PK_User_Codigo'=>'123450089', 'User_Codigo'=>'166478963','User_Nombre1'=>'ruben est3','User_Apellido1'=>'luna',
        'User_Correo'=>'le@mail.com','User_Contra'=>'123','User_Direccion'=>'calle 8#111','FK_User_IdEstado'=>'1','FK_User_IdRol'=>'1'],
        ['PK_User_Codigo'=>'123400009', 'User_Codigo'=>'125471111','User_Nombre1'=>'alejandra pf1','User_Apellido1'=>'luna',
        'User_Correo'=>'lp@mail.com','User_Contra'=>'123','User_Direccion'=>'calle 8#111','FK_User_IdEstado'=>'1','FK_User_IdRol'=>'2'],
        ['PK_User_Codigo'=>'111100009', 'User_Codigo'=>'100601111','User_Nombre1'=>'antonio pf2','User_Apellido1'=>'luna',
        'User_Correo'=>'lp@mail.com','User_Contra'=>'123','User_Direccion'=>'calle 8#111','FK_User_IdEstado'=>'1','FK_User_IdRol'=>'2'],  
        ['PK_User_Codigo'=>'111109999', 'User_Codigo'=>'107001111','User_Nombre1'=>'pepe pf3','User_Apellido1'=>'luna',
        'User_Correo'=>'lp@mail.com','User_Contra'=>'123','User_Direccion'=>'calle 8#111','FK_User_IdEstado'=>'1','FK_User_IdRol'=>'2'],  
        ['PK_User_Codigo'=>'111101119', 'User_Codigo'=>'120001111','User_Nombre1'=>'rodolfo pf4','User_Apellido1'=>'luna',
        'User_Correo'=>'lp@mail.com','User_Contra'=>'123','User_Direccion'=>'calle 8#111','FK_User_IdEstado'=>'1','FK_User_IdRol'=>'2']   
        
        
        ]);
    }
}
