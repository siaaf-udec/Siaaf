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

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'ADMIN_CALIDADPCS';
        $permissionFuncionario->display_name = 'CalidadPsc';
        $permissionFuncionario->description = 'Acceso completo al modulo de CalidadPsc .';
        $permissionFuncionario->module_id = 13;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'USER_CALIDADPCS';
        $permissionFuncionario->display_name = 'CalidadPsc';
        $permissionFuncionario->description = 'Acceso completo al modulo de CalidadPsc .';
        $permissionFuncionario->module_id = 13;
        $permissionFuncionario->save();
        
          //Inicio De Permisos Sobre CRUD De Usuarios

          $permissionCreateUser = new Permission;
          $permissionCreateUser->name = 'CALIDADPCS_CREATE_USER';
          $permissionCreateUser->display_name = 'CalidadPcs';
          $permissionCreateUser->description = 'Permiso para autorizar la creación de usuarios nuevos.';
          $permissionCreateUser->module_id = 13;
          $permissionCreateUser->save();
  
          $permissionSeeUser = new Permission;
          $permissionSeeUser->name = 'CALIDADPCS_SEE_USER';
          $permissionSeeUser->display_name = 'CalidadPcs';
          $permissionSeeUser->description = 'Permiso para autorizar la vista del perfil de los usuarios.';
          $permissionSeeUser->module_id = 13;
          $permissionSeeUser->save();
  
          $permissionUpdateUser = new Permission;
          $permissionUpdateUser->name = 'CALIDADPCS_UPDATE_USER';
          $permissionUpdateUser->display_name = 'CalidadPcs'; 
          $permissionUpdateUser->description = 'Permiso para autorizar la actualización de la información de los usuarios.';
          $permissionUpdateUser->module_id = 13;
          $permissionUpdateUser->save();
  
          $permissionDeleteUser = new Permission;
          $permissionDeleteUser->name = 'CALIDADPCS_DELETE_USER';
          $permissionDeleteUser->display_name = 'CalidadPcs';
          $permissionDeleteUser->description = 'Permiso para autorizar la eliminación de usuarios.';
          $permissionDeleteUser->module_id = 13;
          $permissionDeleteUser->save();
  
          $permissionReportUser = new Permission;
          $permissionReportUser->name = 'CALIDADPCS_REPORT_USER';
          $permissionReportUser->display_name = 'CalidadPcs';
          $permissionReportUser->description = 'Permiso para autorizar sacar los reportes de los usuarios.';
          $permissionReportUser->module_id = 13;
          $permissionReportUser->save();
  
          //Fin De Permisos Sobre CRUD De Usuarios

          //Inicio De Permisos Sobre CRUD De Proyectos

          $permissionCreateUser = new Permission;
          $permissionCreateUser->name = 'CALIDADPCS_CREATE_PROJECT';
          $permissionCreateUser->display_name = 'CalidadPcs';
          $permissionCreateUser->description = 'Permiso para autorizar la creación de proyectos nuevos.';
          $permissionCreateUser->module_id = 13;
          $permissionCreateUser->save();
  
          $permissionSeeUser = new Permission;
          $permissionSeeUser->name = 'CALIDADPCS_SEE_PROJECT';
          $permissionSeeUser->display_name = 'CalidadPcs';
          $permissionSeeUser->description = 'Permiso para autorizar la vista del proyecto.';
          $permissionSeeUser->module_id = 13;
          $permissionSeeUser->save();
  
          $permissionUpdateUser = new Permission;
          $permissionUpdateUser->name = 'CALIDADPCS_UPDATE_PROJECT';
          $permissionUpdateUser->display_name = 'CalidadPcs';
          $permissionUpdateUser->description = 'Permiso para autorizar la actualización de la información de los proyectos.';
          $permissionUpdateUser->module_id = 13;
          $permissionUpdateUser->save();
  
          $permissionDeleteUser = new Permission;
          $permissionDeleteUser->name = 'CALIDADPCS_DELETE_PROJECT';
          $permissionDeleteUser->display_name = 'CalidadPcs';
          $permissionDeleteUser->description = 'Permiso para autorizar la eliminación de proyectos.';
          $permissionDeleteUser->module_id = 13;
          $permissionDeleteUser->save();
  
          $permissionReportUser = new Permission;
          $permissionReportUser->name = 'CALIDADPCS_REPORT_PROJECT';
          $permissionReportUser->display_name = 'CalidadPcs';
          $permissionReportUser->description = 'Permiso para autorizar sacar los reportes de los proyectos.';
          $permissionReportUser->module_id = 13;
          $permissionReportUser->save();
  
          //Fin De Permisos Sobre CRUD De Proyectos
    } 
}