<?php

use App\Container\Permissions\Src\Permission;
use App\Container\Permissions\Src\Role;
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
        $permission->description = 'Acceso al modulo de elementos visuales estandares.';
        $permission->module_id = 8;
        $permission ->save();

        $permission= new Permission;
        $permission->name = 'AUD_MODULE';
        $permission->display_name = 'Auditoria';
        $permission->description = 'Modulo general de auditoria.';
        $permission->module_id = 8;
        $permission ->save();

        $permission= new Permission;
        $permission->name = 'AUD_GENERAL';
        $permission->display_name = 'Auditoria General';
        $permission->description = 'Visualiza la auditoria general de los diferentes modulos.';
        $permission->module_id = 8;
        $permission ->save();

        $permission= new Permission;
        $permission->name = 'MASTER_USER_UDEC';
        $permission->display_name = 'Usuario Udec';
        $permission->description = 'Acceso completo al modulo de administración de usuarios udec.';
        $permission->module_id = 10;
        $permission ->save();

        $permission= new Permission;
        $permission->name = 'USER_UDEC';
        $permission->display_name = 'Usuario Udec';
        $permission->description = 'Acceso al modulo de administración de usuarios udec.';
        $permission->module_id = 10;
        $permission ->save();

        $permission= new Permission;
        $permission->name = 'USER_UDEC_REGIS';
        $permission->display_name = 'Usuario Udec';
        $permission->description = 'Registro de usuarios udec.';
        $permission->module_id = 10;
        $permission ->save();

        $role = Role::findOrFail(1);
        $role->perms()->sync([1, 2, 3, 4, 5]);
    }
}