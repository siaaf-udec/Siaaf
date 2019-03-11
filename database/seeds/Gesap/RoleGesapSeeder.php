<?php

use App\Container\Permissions\src\Role;
use \Illuminate\Database\Seeder;

class RoleGesapSeeder extends Seeder
{

    public function run()
    {
        Role::insert([
            ['name'=>'Coordinator_Gesap','display_name'=>'Coordinador','description'=>'Docente de las materias de Investigacion, Encargados de las radicaciones'],
            ['name'=>'Evaluator_Gesap','display_name'=>'Docente','description'=>'Docentes investigadores o encargados de proyectos'],
            ['name'=>'Student_Gesap','display_name'=>'Estudiante','description'=>'Estudiantes proponentes de anteproyecto']

        ]);
    }
}
