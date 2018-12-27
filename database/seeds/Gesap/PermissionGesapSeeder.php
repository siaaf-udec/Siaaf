<?php

use App\Container\Permissions\src\Permission;
use \Illuminate\Database\Seeder;
use App\Container\Permissions\src\Role;

class PermissionGesapSeeder extends Seeder
{

    public function run()
    {
        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'GESAP_MODULE';
        $permissionFuncionario->display_name = 'Modulo Gesap';
        $permissionFuncionario->description = 'Acceso a solo este modulo';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();
        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'LIST_ANTEPROYECTOS';
        $permissionFuncionario->display_name = 'Parqueaderos';
        $permissionFuncionario->description = 'Acceso a los anteproyectos abiertos para su realizacion';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();
        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'LIST_PROYECTOS';
        $permissionFuncionario->display_name = 'Parqueaderos';
        $permissionFuncionario->description = 'Acceso a los Proyectos que ya fueron anteriormente aprovados';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();
        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'ADD_USER_GESAP';
        $permissionFuncionario->display_name = 'Listar Usuarios Gesap';
        $permissionFuncionario->description = 'Ver usuarios de Gesap';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();
        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'FIND_DB_GESAP';
        $permissionFuncionario->display_name = 'Parqueaderos';
        $permissionFuncionario->description = 'Acceso completo a la modulo de parqueaderos.';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();
        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'REPORT_GESAP';
        $permissionFuncionario->display_name = 'Reportes Gesap';
        $permissionFuncionario->description = 'Hacer Reportes por diferentes categorias de Gesap';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();
        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'GRAPHICS_GESAP';
        $permissionFuncionario->display_name = 'Graficos Gesap';
        $permissionFuncionario->description = 'Hacer Graficas por diferentes categorias de Gesap';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

            
            
            /* fin generales*/
           
        

        
    }
}
