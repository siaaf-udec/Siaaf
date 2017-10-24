<?php

use App\Container\Permissions\Src\Role;
use \Illuminate\Database\Seeder;

class RoleAudiovisualsSeeder extends Seeder
{
    public function run()
    {
        $roles = [

            ['name'=>'ADMIN_AUDIOVISUALES','display_name'=>'Administrador de Audiovisuales','description'=>'El rol administrador sera el encargado de realizar prestamos.'],
            ['name'=>'FUNC_AUDIOVISUALES','display_name'=>'Funcionario de Audiovisuales','description'=>'El rol funcionario pertenece a los docentes y estudiantes de la universidad.']

        ];

        foreach ($roles as $rol ) {
            $aux = new Role;
            $aux->name = $rol['name'];
            $aux->display_name = $rol['display_name'];
            $aux->description = $rol['description'];

            $aux->save();
        }
    }

}