<?php

use App\Container\Permissions\Src\Role;
use \Illuminate\Database\Seeder;

class RoleAutoevaluationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            ['name'=>'SuperAdmin_Autoevaluation','display_name'=>'Super Administrador','description'=>'Encargado del manejo de usuarios y lineamiento del CNA'],
            ['name'=>'PrimarySource_Autoevaluation','display_name'=>'Encuestas','description'=>'Encargado de crear encuestas'],
            ['name'=>'SecondarySource_Autoevaluation','display_name'=>'Documental','description'=>'Encargado de subir documentos']

        ]);
    }
}
