<?php

use App\Container\Permissions\src\Role;
use \Illuminate\Database\Seeder;

class RoleGesapSeeder extends Seeder
{

    public function run()
    {
        Role::insert([
            ['name'=>'EstudianteGesap','display_name'=>'EstudianteGesap','description'=>'Estudiantes de la plataforma GESAP'],
            ['name'=>'DocenteGesap','display_name'=>'DocenteGesap','description'=>'Docentes investigadores o encargados de proyectos'],
            ['name'=>'AdminGesap','display_name'=>'AdminGesap','description'=>'Administradores de GESAP']

        ]);
    }
}
