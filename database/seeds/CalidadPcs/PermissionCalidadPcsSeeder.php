<?php

use Illuminate\Database\Seeder;
/*
 * Modelos
 */
use App\Container\Permissions\Src\Permission;

class PermissionCalidadPcsSeeder extends Seeder
{

    public function run()
    {
        //Inicio De Permisos Generales De Los Roles
        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'CALIDADPCS_MODULE';
        $permissionFuncionario->display_name = 'CalidadPsc';
        $permissionFuncionario->description = 'Acceso completo al modulo de CalidadPsc .';
        $permissionFuncionario->module_id = 13;
        $permissionFuncionario->save();
    }
}