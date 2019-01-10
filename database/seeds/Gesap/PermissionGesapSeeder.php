<?php

use App\Container\Permissions\src\Permission;
use \Illuminate\Database\Seeder;
use App\Container\Permissions\src\Role;

class PermissionGesapSeeder extends Seeder
{

    public function run()
    {

        //Inicio para los permisos generales de administrador

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
        $permissionFuncionario->description = 'Aministarcion de los usuarios de Gesap';
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
        $permissionFuncionario->name = 'GESAP_REPORT_USER';
        $permissionFuncionario->display_name = 'Anteproyecto Gesap';
        $permissionFuncionario->description = 'Permiso para hacer reportes de los usuarios en general';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

       
        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'DELATE_ANTE';
        $permissionFuncionario->display_name = 'Anteproyecto Gesap';
        $permissionFuncionario->description = 'Permiso para eliminar anteproyectos';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'GESAP_CREATE_USER';
        $permissionFuncionario->display_name = 'Anteproyecto Gesap';
        $permissionFuncionario->description = 'Permiso para crear nuevos anteproyectos';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();


        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'UPDATE_ANTE';
        $permissionFuncionario->display_name = 'Anteproyecto Gesap';
        $permissionFuncionario->description = 'Permiso para editar anteproyectos';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'ADD_ANTEPROYECTO';
        $permissionFuncionario->display_name = 'Anteproyecto Gesap';
        $permissionFuncionario->description = 'Permiso para el admin de registrar un anteproyecto';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'UPDATE_ANTEPROYECTO';
        $permissionFuncionario->display_name = 'Anteproyecto Gesap';
        $permissionFuncionario->description = 'Permiso para el admin de editar un anteproyecto';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'DELETE_ANTEPROYECTO';
        $permissionFuncionario->display_name = 'Anteproyecto Gesap';
        $permissionFuncionario->description = 'Permiso para el admin de eliminar un anteproyecto';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();
            
        //Fin de permisos para el CRUD de Admin
        
        //Inicio de los permisos para e crud de Usuarios con el rol Admin
        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'ADD_USER';
        $permissionFuncionario->display_name = 'Usuarios Gesap';
        $permissionFuncionario->description = 'Permiso para el admin de registrar un usuario';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'UPDATE_USER';
        $permissionFuncionario->display_name = 'Usuarios Gesap';
        $permissionFuncionario->description = 'Permiso para el admin de editar un usuario';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'DELETE_USER';
        $permissionFuncionario->display_name = 'Usuarios Gesap';
        $permissionFuncionario->description = 'Permiso para el admin de eliminar un usuario';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();
        

        //Fin de los permisos para e crud de Usuarios con el rol Admin
    }
}
