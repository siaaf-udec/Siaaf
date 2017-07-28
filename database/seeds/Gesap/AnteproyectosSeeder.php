<?php

use Illuminate\Database\Seeder;
use App\Container\gesap\src\Anteproyecto;
class AnteproyectosSeeder extends Seeder
{

    public function run()
    {
        Anteproyecto::insert([
            ['name'=>'Coordinator_Gesap','display_name'=>'Coordinador','description'=>'--'],
            ['name'=>'Evaluator_Gesap','display_name'=>'Docente','description'=>'--'],
            ['name'=>'Student_Gesap','display_name'=>'Estudiante','description'=>'--']
        ]);
        
    }
}