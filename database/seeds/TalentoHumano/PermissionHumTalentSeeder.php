<?php

/**
 * Created by PhpStorm.
 * User: Yeison Gomez
 * Date: 5/10/2017
 * Time: 3:55 PM
 */
use Illuminate\Database\Seeder;
/*
 * Modelos
 */
use App\Container\Permissions\Src\Permission;
use App\Container\Permissions\Src\Role;

class PermissionHumTalentSeeder extends Seeder
{

    public function run ()
    {

        $permission= new Permission;
        $permission->name = 'FUNC_RRHH';
        $permission->display_name = 'HumTalent';
        $permission->description = 'Acceso completo a la modulo de recursos humanos.';
        $permission->module_id = 6;
        $permission ->save();

        $role = Role:: where('name' , 'RRHH')->get(['id'])->first();
        $permiso = Permission::where('name', 'FUNC_RRHH')->first();
        $permiso->roles()->sync($role);
    }
}