<?php

use App\Container\Permissions\src\Role;
use Illuminate\Database\Seeder;

class RoleInteraccionSeeder extends Seeder
{

    public function run()
    {
        Role::insert([
            ['name'=>'Admin_uni','display_name'=>'Administrador','description'=>'--'],
            ['name'=>'Coordinador_uni','display_name'=>'Coordinador','description'=>'--'],
            ['name'=>'Funcionario_uni','display_name'=>'Funcionario','description'=>'--'],
            ['name'=>'Pasante_uni','display_name'=>'Pasante','description'=>'--'],
            ['name'=>'Empresario_uni','display_name'=>'Empresario','description'=>'--']

        ]);
    }
}
