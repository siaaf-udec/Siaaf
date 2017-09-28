<?php

use App\Container\Permissions\Src\Role;
use \Illuminate\Database\Seeder;

class RoleGesapSeeder extends Seeder
{

    public function run()
    {
        Role::insert([
            ['name'=>'Administrator_Gesap','display_name'=>'Administrador','description'=>'--'],
            ['name'=>'Coordinator_Gesap','display_name'=>'Coordinador','description'=>'--'],
            ['name'=>'Evaluator_Gesap','display_name'=>'Docente','description'=>'--'],
            ['name'=>'Student_Gesap','display_name'=>'Estudiante','description'=>'--']
        ]);
    }
}