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

        //Inicio de permisos para el CRUD de anteproyectos con el rol Admin
      
        
        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'GESAP_REPORT_USER';
        $permissionFuncionario->display_name = 'Anteproyecto Gesap';
        $permissionFuncionario->description = 'Permiso para hacer reportes de los usuarios en general';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

       
        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'DELETE_ANTE';
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
        $permissionFuncionario->name = 'VER_ANTE';
        $permissionFuncionario->display_name = 'Anteproyecto Gesap';
        $permissionFuncionario->description = 'Permiso para el admin de ver lainformacion completa del anteporyecto';
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
        
        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'GESAP_MCT_DATE';
        $permissionFuncionario->display_name = 'Anteproyecto Gesap';
        $permissionFuncionario->description = 'Permiso para el admin de colocar fechas limites de radicacion del MCT';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'DELETE_DESARROLLADOR';
        $permissionFuncionario->display_name = 'Anteproyecto Gesap';
        $permissionFuncionario->description = 'Permiso para el admin de eliminar un desarrollador';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();
        
        
        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'DELETE_ACTIVIDAD_MCT';
        $permissionFuncionario->display_name = 'Anteproyecto Gesap';
        $permissionFuncionario->description = 'Permiso para el admin de eliminar actividades del Mct';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'GESAP_ADMIN_MCT';
        $permissionFuncionario->display_name = 'Anteproyecto Gesap';
        $permissionFuncionario->description = 'Permiso para el admin Editar los contenidos entregables del MCT';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'TEACHER_GESAP';
        $permissionFuncionario->display_name = 'profesor Gesap';
        $permissionFuncionario->description = 'Permiso para el profesor';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();
        
        
        //Fin de permisos para el CRUD de Admin
        //permisos Estudiantes
        
        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'STUDENT_GESAP';
        $permissionFuncionario->display_name = 'Gesap estudiante';
        $permissionFuncionario->description = 'Permiso el estudiante';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'VER_ACTIVIDAD';
        $permissionFuncionario->display_name = 'Gesap estudiante';
        $permissionFuncionario->description = 'Permiso el estudiante de ver las actividades de su anteproyecto';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();
        

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'MY_ANTE_PROYECTO';
        $permissionFuncionario->display_name = 'Gesap estudiante';
        $permissionFuncionario->description = 'Permiso para que el estudiante vea su anteproyecto';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();
        
        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'ADD_ACTIVITY_STUDENT';
        $permissionFuncionario->display_name = 'Gesap estudiante';
        $permissionFuncionario->description = 'Permiso para que el estudiante cargue su actividad de MCT';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();
        
        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'ACTIVITY_STUDENT_MCT';
        $permissionFuncionario->display_name = 'Gesap estudiante';
        $permissionFuncionario->description = 'Permiso para ingresar a las actividades del MCT';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'ACTIVITY_STUDENT_COMENT';
        $permissionFuncionario->display_name = 'Gesap estudiante';
        $permissionFuncionario->description = 'Permiso para hacer un comentario en la actividad';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'ACTIVITY_STUDENT_RELOAD';
        $permissionFuncionario->display_name = 'Gesap estudiante';
        $permissionFuncionario->description = 'Permiso para modificar el documento en la actividad';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();
        
        //Fin permisos Estudiantes
        // permisos Coordinadores/jurados
        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'ANTE_DIRECTOR';
        $permissionFuncionario->display_name = 'Gesap profesor';
        $permissionFuncionario->description = 'Permiso para ver los anteproyectos asignados como director o predirector';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'ANTE_JURADO';
        $permissionFuncionario->display_name = 'Gesap profesor';
        $permissionFuncionario->description = 'Permiso para ver los anteproyectos asignados como jurado';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'ANTE_CONFIRM';
        $permissionFuncionario->display_name = 'Gesap profesor';
        $permissionFuncionario->description = 'Permiso para confirmar la asignacion de proyecto de grado';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'ANTE_COMENT';
        $permissionFuncionario->display_name = 'Gesap profesor';
        $permissionFuncionario->description = 'Permiso para realizar un comentario en la actividad del MCT';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'PROYECT_COMENT';
        $permissionFuncionario->display_name = 'Gesap profesor';
        $permissionFuncionario->description = 'Permiso para realizar un comentario en la actividad del Libro de proyecto de grado';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();


        // Fin permisos Coordinadores/jurados
        
        //Inicio de los permisos para el crud de Usuarios con el rol Admin
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
