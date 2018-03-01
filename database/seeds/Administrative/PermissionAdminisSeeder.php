<?php

use Illuminate\Database\Seeder;
/*
 * Modelos
 */
use App\Container\Permissions\Src\Permission;

class PermissionAdminisSeeder extends Seeder
{

    public function run()
    {
        //Inicio De Permisos Generales De Los Roles
        $permissionAdminis = new Permission;
        $permissionAdminis->name = 'ADMINIS_MODULE';
        $permissionAdminis->display_name = 'Administrativo';
        $permissionAdminis->description = 'Acceso completo a la modulo administrativo.';
        $permissionAdminis->module_id = 9;
        $permissionAdminis->save();

        //Inicio De Permisos Generales De Los Roles
        $permissionAdminis = new Permission;
        $permissionAdminis->name = 'ADMIN_ADMINIS';
        $permissionAdminis->display_name = 'Administrativo';
        $permissionAdminis->description = 'Acceso completo a la modulo administrativo.';
        $permissionAdminis->module_id = 9;
        $permissionAdminis->save();


    }
}   