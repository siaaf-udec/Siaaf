<?php

use App\Container\Permissions\Src\Role;
use \Illuminate\Database\Seeder;

class RoleGesapSeeder extends Seeder
{

    public function run()
    {
        Role::insert([
<<<<<<< Updated upstream
            ['name'=>'Administrator_Gesap','display_name'=>'Administrador','description'=>'--'],
            ['name'=>'Coordinator_Gesap','display_name'=>'Coordinador','description'=>'--'],
            ['name'=>'Evaluator_Gesap','display_name'=>'Docente','description'=>'--'],
            ['name'=>'Student_Gesap','display_name'=>'Estudiante','description'=>'--']
=======
            ['name'=>'Coordinator_uni','display_name'=>'Coordinador','description'=>'--'],
            ['name'=>'Funcionario_uni','display_name'=>'Funcionario','description'=>'--'],
            ['name'=>'Pasante_uni','display_name'=>'Pasante','description'=>'--'],
            ['name'=>'Empresario_uni_Gesap','display_name'=>'Empresario','description'=>'--'],
            
>>>>>>> Stashed changes
        ]);
    }
}