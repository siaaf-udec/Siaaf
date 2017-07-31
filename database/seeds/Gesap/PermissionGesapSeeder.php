<?php

use App\Container\Permissions\Src\Permission;
use \Illuminate\Database\Seeder;

class PermissionGesapSeeder extends Seeder
{

    public function run()
    {
        Permission::insert([
            ['name'=>'Create_Project_Gesap','display_name'=>'Crear Anteproyecto','description'=>'--','module_id'=>'7'],
            ['name'=>'See_Observations_Gesap','display_name'=>'Ver Observaciones','description'=>'--','module_id'=>'7'],
            ['name'=>'Jury_List_Gesap','display_name'=>'Proyectos de Jurado','description'=>'--','module_id'=>'7'],
            ['name'=>'Director_List_Gesap','display_name'=>'Proyectos de Director','description'=>'--','module_id'=>'7']
        ]);
    }
}