<?php

use App\Container\Permissions\Src\Permission;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission= new Permission;
        $permission->name = 'MASTER_PERMISSIOM';
        $permission->display_name = 'Permisos de Usuario';
        $permission->description = 'Acceso al modulo de permisos.';
        $permission->module_id = 8;
        $permission ->save();

        $permission= new Permission;
        $permission->name = 'MASTER_USERS';
        $permission->display_name = 'Usuarios';
        $permission->description = 'Acceso al modulo de usuarios.';
        $permission->module_id = 8;
        $permission ->save();

        $permission= new Permission;
        $permission->name = 'MASTER_ELEMENTS';
        $permission->display_name = 'Elementos';
        $permission->description = 'Acceso al modulo de elementos visuales estandares .';
        $permission->module_id = 8;
        $permission ->save();

    }
}