<?php

use Illuminate\Database\Seeder;
use App\Container\Permissions\src\Role;

class RoleAdminRegistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            ['name'=>'Adminis_AdminRegist','display_name'=>'Administrador de admisiones y registro','description'=>'Persona que contiene todos los permisos de super administrador.'],
            ['name'=>'Registro_AdminRegist','display_name'=>'Registro de Ingreso de admisiones y registro','description'=>'Rol para el registro de entradas a admisiones y registros.']
        ]);
    }
}
