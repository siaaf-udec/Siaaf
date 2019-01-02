<?php

use App\Container\Permissions\src\Permission;
use \Illuminate\Database\Seeder;
use App\Container\Permissions\src\Role;

class PermissionGesapSeeder extends Seeder
{

    public function run()
    {

        //Inicio para los permisos generales de los Roles

        $permissionAdmin = new Permission;
        $permissionAdmin->name = 'ADMIN_GESAP';
        $permissionAdmin->display_name = 'Gesap';
        $permissionAdmin->description = 'Acceso completo al modulo de gesap.';
        $permissionAdmin->module_id = 7;
        $permissionAdmin->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'GESAP_MODULE';
        $permissionFuncionario->display_name = 'Modulo Gesap';
        $permissionFuncionario->description = 'Acceso a solo este modulo';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'LIST_ANTEPROYECTOS';
        $permissionFuncionario->display_name = 'Lista de Anteproyectos';
        $permissionFuncionario->description = 'Acceso a los anteproyectos abiertos para su realizacion';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'LIST_PROYECTOS';
        $permissionFuncionario->display_name = 'Lista de Proyectos';
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
        $permissionFuncionario->display_name = 'Usuarios registrados';
        $permissionFuncionario->description = 'Acceso a los usuarios que se han registrado.';
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

        
        //Fin de permisos generales para los roles

        //Inicio de permisos para el CRUD de Admin

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'ADD_ANTEPROYECTO';
        $permissionFuncionario->display_name = 'Anteproyecto Gesap';
        $permissionFuncionario->description = 'Permiso para el admin de registrar un anteproyecto';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();
            
        //Fin de permisos para el CRUD de Admin
        
        
    }
}
