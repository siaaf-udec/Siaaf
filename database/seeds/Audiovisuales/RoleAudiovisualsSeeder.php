<?php

use App\Container\Permissions\Src\Role;
use \Illuminate\Database\Seeder;

class RoleAudiovisualsSeeder extends Seeder
{

    public function run()
    {
        Role::insert([
            ['name'=>'Administrador_Audiovisuales','display_name'=>'Administrador de Audiovisuales','description'=>'El rol administrador sera el encargado de realizar prestamos.'],
            ['name'=>'Funcionario_Audiovisuales','display_name'=>'Funcionario de Audiovisuales','description'=>'El rol funcionario pertenece a los docentes y estudiantes de la universidad.']
        ]);
    }
}