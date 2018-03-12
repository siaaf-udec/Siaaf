<?php

use App\Container\Permissions\Src\Role;
use \Illuminate\Database\Seeder;

class RoleAdminisSeeder extends Seeder
{
    public function run()
    {
        $roles = [

            ['name'=>'ADMIN_ADMINISTRATIVO','display_name'=>'Administrador de Administrativos','description'=>'El rol administrador sera el encargado de gestionar toda la parte administrativa.']

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