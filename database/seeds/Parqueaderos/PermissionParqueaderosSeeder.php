<?php

use Illuminate\Database\Seeder;
/*
 * Modelos
 */
use App\Container\Permissions\Src\Permission;

class PermissionParqueaderosSeeder extends Seeder
{

    public function run ()
    {

        $permission= new Permission;
        $permission->name = 'FUNC_CARPARK';
        $permission->display_name = 'Parqueaderos';
        $permission->description = 'Acceso completo a la modulo de parqueaderos.';
        $permission->module_id = 3;
        $permission ->save();

        $permission2 = new Permission;
        $permission2->name = 'ADMIN_CARPARK';
        $permission2->display_name = 'Parqueaderos';
        $permission2->description = 'Acceso completo a la modulo de parqueaderos.';
        $permission2->module_id = 3;
        $permission2 ->save();


        
    }
}