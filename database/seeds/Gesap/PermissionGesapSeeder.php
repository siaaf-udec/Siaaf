<?php

use App\Container\Permissions\src\Permission;
use \Illuminate\Database\Seeder;
use App\Container\Permissions\src\Role;

class PermissionGesapSeeder extends Seeder
{

    public function run()
    {

        //Inicio para los permisos generales de coordinador

        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'coordinador_GESAP';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'Acceso completo al modulo de gesap.';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();

        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_ADMIN_MCT';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'Acceso para modificar al contenido de mct y fechas.';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();

        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_REPORT_ANTE_ALL';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'Acceso a un reporte general de anteproyectos de grado.';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();
        
        

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'GESAP_MODULE';
        $permissionFuncionario->display_name = 'Modulo Gesap';
        $permissionFuncionario->description = 'Acceso a solo este modulo';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();
        
        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'DELETE_JUDMENT';
        $permissionFuncionario->display_name = 'Lista de Anteproyectos';
        $permissionFuncionario->description = 'permiso del coordinador para eliminar jurados asignados';
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
        $permissionFuncionario->description = 'Acceso a los Proyectos que ya fueron anteriormente aprobados';
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

        //Inicio de permisos para el CRUD de anteproyectos con el rol coordinador
      
        
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
        $permissionFuncionario->name = 'GESAP_CREATE_ANTE';
        $permissionFuncionario->display_name = 'Anteproyecto Gesap';
        $permissionFuncionario->description = 'Permiso para crear anteproyectos';
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
        $permissionFuncionario->description = 'Permiso para el coordinador de registrar un anteproyecto';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'VER_ANTE';
        $permissionFuncionario->display_name = 'Anteproyecto Gesap';
        $permissionFuncionario->description = 'Permiso para el coordinador de ver lainformacion completa del anteporyecto';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'UPDATE_ANTEPROYECTO';
        $permissionFuncionario->display_name = 'Anteproyecto Gesap';
        $permissionFuncionario->description = 'Permiso para el coordinador de editar un anteproyecto';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'DELETE_ANTEPROYECTO';
        $permissionFuncionario->display_name = 'Anteproyecto Gesap';
        $permissionFuncionario->description = 'Permiso para el coordinador de eliminar un anteproyecto';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'GESAP_REPORT_ANTE';
        $permissionFuncionario->display_name = 'Anteproyecto Gesap';
        $permissionFuncionario->description = 'Permiso para el coordinador de ver todos los anteproyectos';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'REPORT_ANTE';
        $permissionFuncionario->display_name = 'Anteproyecto Gesap';
        $permissionFuncionario->description = 'Permiso para el coordinador de ver un anteproyecto por separado';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'CANCEL_ANTE';
        $permissionFuncionario->display_name = 'Anteproyecto Gesap';
        $permissionFuncionario->description = 'Permiso para el coordinador cancelar anteproyecto';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'CANCEL_GESAP';
        $permissionFuncionario->display_name = 'Anteproyecto Gesap';
        $permissionFuncionario->description = 'Permiso para el boton de cancelar, volver, etc';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'SUBMIT_GESAP';
        $permissionFuncionario->display_name = 'Anteproyecto Gesap';
        $permissionFuncionario->description = 'Permiso para el boton de aceptar, siguiente, etc';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();
        
        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'GESAP_MCT_DATE';
        $permissionFuncionario->display_name = 'Anteproyecto Gesap';
        $permissionFuncionario->description = 'Permiso para el coordinador de colocar fechas limites de radicacion del MCT';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'DELETE_DEVELOPER';
        $permissionFuncionario->display_name = 'Anteproyecto Gesap';
        $permissionFuncionario->description = 'Permiso para el coordinador de eliminar un desarrollador';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();
        
        
        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'DELETE_ACTIVIDAD_MCT';
        $permissionFuncionario->display_name = 'Anteproyecto Gesap';
        $permissionFuncionario->description = 'Permiso para el coordinador de eliminar actividades del Mct';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'TEACHER_GESAP';
        $permissionFuncionario->display_name = 'Anteproyecto Gesap';
        $permissionFuncionario->description = 'Permiso para el docente';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'ADD_DEVELOPER';
        $permissionFuncionario->display_name = 'Anteproyecto Gesap';
        $permissionFuncionario->description = 'Permiso para coordinador de asignar un desarollador';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'ADD_DEVELOPER_VW';
        $permissionFuncionario->display_name = 'Anteproyecto Gesap';
        $permissionFuncionario->description = 'Permiso para coordinador ver un desarollador';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'ADD_JUDMENT_VW';
        $permissionFuncionario->display_name = 'Anteproyecto Gesap';
        $permissionFuncionario->description = 'Permiso para coordinador de asignar un jurado';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'GESAP_CREATE_ACT_MCT';
        $permissionFuncionario->display_name = 'Anteproyecto Gesap';
        $permissionFuncionario->description = 'Permiso para el coordinador de crear una actividad';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();
        
        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'GESAP_FECHAS_MCT';
        $permissionFuncionario->display_name = 'Anteproyecto Gesap';
        $permissionFuncionario->description = 'Permiso para el coordinador de crear, modificar o elimiar fechas de radicacion';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'USER_REPORTS';
        $permissionFuncionario->display_name = 'Anteproyecto Gesap';
        $permissionFuncionario->description = 'Permiso general para reporte de usuarios';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'USER_REPORT';
        $permissionFuncionario->display_name = 'Anteproyecto Gesap';
        $permissionFuncionario->description = 'Permiso para reporte de usuario individual';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'ADMIN_GESAP';
        $permissionFuncionario->display_name = 'Anteproyecto Gesap';
        $permissionFuncionario->description = 'Permiso para ver todo gesap coordinador';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        
        //Fin de permisos para el CRUD de coordinador
        //permisos Estudiantes
        
        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'STUDENT_GESAP';
        $permissionFuncionario->display_name = 'Gesap estudiante';
        $permissionFuncionario->description = 'Permiso el estudiante';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'FOLDER';
        $permissionFuncionario->display_name = 'Gesap estudiante';
        $permissionFuncionario->description = 'Permiso para ver la lista de actividaddes de MCT y Req. IEEE.';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'VER_REQ_STUDENT';
        $permissionFuncionario->display_name = 'Gesap estudiante';
        $permissionFuncionario->description = 'Permiso el estudiante para ver la lista de actividades Req. IEEE';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();


        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'VER_ACTIVIDAD_ESTUDIANTE';
        $permissionFuncionario->display_name = 'Gesap estudiante';
        $permissionFuncionario->description = 'Permiso el estudiante de ver las actividades de su anteproyecto';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();
        
        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'VER_COMENTARIO_JURADO';
        $permissionFuncionario->display_name = 'Gesap estudiante';
        $permissionFuncionario->description = 'Permiso para ver comentario y la decision del jurado';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'MY_ANTE_PROYECTO';
        $permissionFuncionario->display_name = 'Gesap estudiante';
        $permissionFuncionario->description = 'Permiso para que el estudiante vea su anteproyecto';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();
        
        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'ADD_ACTIVIDAD_STUDENT';
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
        $permissionFuncionario->name = 'STUDENT_COMENT';
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

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'SUBMIT_STUDENT';
        $permissionFuncionario->display_name = 'Gesap estudiante';
        $permissionFuncionario->description = 'Permiso para el estudainte de subir una actividad';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();
        
        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'MYS_SOLICITUDES_STUDENT';
        $permissionFuncionario->display_name = 'Gesap estudiante';
        $permissionFuncionario->description = 'Permiso para que el estudiante VEA SUS solicitudES ';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'GESAP_SOLICITUD_STUDENT';
        $permissionFuncionario->display_name = 'Gesap estudiante';
        $permissionFuncionario->description = 'Permiso para que el estudiante haga alguna solicitud al coordinador';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'VER_ANTE_DIRECTOR';
        $permissionFuncionario->display_name = 'Gesap estudiante';
        $permissionFuncionario->description = 'Permiso para que el estudiante haga alguna solicitud al coordinador';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'MY_SOLICITUD';
        $permissionFuncionario->display_name = 'Gesap docente';
        $permissionFuncionario->description = 'Permiso para ver las solicitudes docente';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'DELETE_SOL';
        $permissionFuncionario->display_name = 'Gesap docente';
        $permissionFuncionario->description = 'Permiso para eliminar la solicitud docente';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();
        
        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'ADD_JUDMENT';
        $permissionFuncionario->display_name = 'Gesap estudiante';
        $permissionFuncionario->description = 'Permiso ara el coordinador de agregar un jurado.';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();
        
        
        
        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'STUDENT_BACK';
        $permissionFuncionario->display_name = 'Gesap estudiante';
        $permissionFuncionario->description = 'habilitar el boton back para el rol estudiante';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();
        
        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'RADICAR';
        $permissionFuncionario->display_name = 'Gesap estudiante';
        $permissionFuncionario->description = 'Permiso para radicar anteproyecto Y PROYECTO';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'CANCEL_STUDENT';
        $permissionFuncionario->display_name = 'Gesap estudiante';
        $permissionFuncionario->description = 'Permiso para el boton de volver y cancelar';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'BANCO_PROYECTOS';
        $permissionFuncionario->display_name = 'Gesap estudiante';
        $permissionFuncionario->description = 'Permiso para el estudiante de ver el banco de proyectos';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'DELETE_STUDENT';
        $permissionFuncionario->display_name = 'Gesap estudiante';
        $permissionFuncionario->description = 'Permiso para el estudiante de ver eliminar tablas del MCT y Req. IEEE';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'UPDATE_STUDENT';
        $permissionFuncionario->display_name = 'Gesap estudiante';
        $permissionFuncionario->description = 'Permiso para el estudiante de editar actividades del MCT y Req. IEEE';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'VER_FOLDER';
        $permissionFuncionario->display_name = 'Gesap estudiante';
        $permissionFuncionario->description = 'Permiso para el estudiante de ver proyectos en el banco de proyectos';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'VER_LIBRO_ACTIVIDADES';
        $permissionFuncionario->display_name = 'Gesap estudiante';
        $permissionFuncionario->description = 'Permiso para el estudiante de ver la lista de actividades del proyecto';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();


        
        //Fin permisos Estudiantes

        // permisos Docentes - Directores/jurados
            
        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'ANTE_DIRECTOR';
        $permissionFuncionario->display_name = 'Gesap docente';
        $permissionFuncionario->description = 'Permiso para ingresar al modulo como director o predirector';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'VER_REQ_DOCENTE';
        $permissionFuncionario->display_name = 'Gesap docente';
        $permissionFuncionario->description = 'Permiso para ver lista de requerimientos';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'VER_REQU_DOCENTE';
        $permissionFuncionario->display_name = 'Gesap docente';
        $permissionFuncionario->description = 'Permiso para ver lista de actividades requerimientos por separado';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'DECISION_JUDMENT';
        $permissionFuncionario->display_name = 'Gesap docente';
        $permissionFuncionario->description = 'Permiso para dar un estado de aprobado, reprobado y aplazado';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'VER_ACT_DOCENTE';
        $permissionFuncionario->display_name = 'Gesap docente';
        $permissionFuncionario->description = 'Permiso para el boton de ver una actividad';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'ANTE_JURADO';
        $permissionFuncionario->display_name = 'Gesap docente';
        $permissionFuncionario->description = 'Permiso para ver los anteproyectos asignados como jurado';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();
        
        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'VER_ANTE_JURADO';
        $permissionFuncionario->display_name = 'Gesap docente';
        $permissionFuncionario->description = 'Permiso para ver los anteproyectos asignados como director o predirector';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();
        
        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'DOCENTE_SOLICITUD';
        $permissionFuncionario->display_name = 'Gesap docente';
        $permissionFuncionario->description = 'Permiso para pedir una solicitud especial con rol docente';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'BACK_DOCENTE';
        $permissionFuncionario->display_name = 'Gesap docente';
        $permissionFuncionario->description = 'habilita el back para docente';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'AVAL_DOCENTE';
        $permissionFuncionario->display_name = 'Gesap docente';
        $permissionFuncionario->description = 'da el aval de alguna actividad en especifico';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();
        
        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'ANTE_CONFIRM';
        $permissionFuncionario->display_name = 'Gesap docente';
        $permissionFuncionario->description = 'Permiso para confirmar la asignacion de proyecto de grado';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'ANTE_COMENT';
        $permissionFuncionario->display_name = 'Gesap docente';
        $permissionFuncionario->description = 'Permiso para realizar un comentario en la actividad del MCT';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'PROYECT_COMENT';
        $permissionFuncionario->display_name = 'Gesap docente';
        $permissionFuncionario->description = 'Permiso para realizar un comentario en la actividad del Libro de proyecto de grado';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'CANCEL_DOCENTE';
        $permissionFuncionario->display_name = 'Gesap docente';
        $permissionFuncionario->description = 'Permiso para el boton de volver y cancelar';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'DOCENTE_GESAP';
        $permissionFuncionario->display_name = 'Gesap docente';
        $permissionFuncionario->description = 'Permiso para ver la vista principal de docente';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'USER_ANTE_DIRECTOR';
        $permissionFuncionario->display_name = 'Gesap docente';
        $permissionFuncionario->description = 'Permiso para director de ver el anteproyecto';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'USER_ANTE_JURADO';
        $permissionFuncionario->display_name = 'Gesap docente';
        $permissionFuncionario->description = 'Permiso para jurado de ver el anteproyecto';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'CALIFICAR_JURADO';
        $permissionFuncionario->display_name = 'Gesap docente';
        $permissionFuncionario->description = 'Permiso para jurado de tomar una decision de aprobado, reprobado o aplazado';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'VER_PRO_DIRECTOR';
        $permissionFuncionario->display_name = 'Gesap docente';
        $permissionFuncionario->description = 'Permiso para director de ver el proyecto';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'VER_PRO_JURADO';
        $permissionFuncionario->display_name = 'Gesap docente';
        $permissionFuncionario->description = 'Permiso para jurado de ver el proyecto';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'VER_ACTIVIDADES_DOCENTE';
        $permissionFuncionario->display_name = 'Gesap docente';
        $permissionFuncionario->description = 'Permiso al docente de ver las actividades';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'VER_ACTIVIDADES';
        $permissionFuncionario->display_name = 'Gesap docente';
        $permissionFuncionario->description = 'Permiso para ver las actividades del MCT y Req. IEEE';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'ASIGNAR_DESARROLLADORES';
        $permissionFuncionario->display_name = 'Gesap docente';
        $permissionFuncionario->description = 'Permiso para asignar desarrolladores al anteproyecto';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'DOCENTE_COMENT';
        $permissionFuncionario->display_name = 'Gesap docente';
        $permissionFuncionario->description = 'Permiso al docente para crear comentario';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'APROBAR_ACTIVIDAD';
        $permissionFuncionario->display_name = 'Gesap docente';
        $permissionFuncionario->description = 'Permiso al director para aprobar cada una de la actividades del MCT y Req. IEEE.';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'VER_ACTIVIDAD_PROYECTO';
        $permissionFuncionario->display_name = 'Gesap docente';
        $permissionFuncionario->description = 'Permiso al docente para ver las actividades del proyecto.';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();



        // Fin permisos Coordinadores/jurados
        
        //Inicio de los permisos para el crud de Usuarios con el rol coordinador
        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'ADD_USER';
        $permissionFuncionario->display_name = 'Usuarios Gesap';
        $permissionFuncionario->description = 'Permiso para el coordinador de registrar un usuario';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'UPDATE_USER';
        $permissionFuncionario->display_name = 'Usuarios Gesap';
        $permissionFuncionario->description = 'Permiso para el coordinador de editar un usuario';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'CANCEL_USER';
        $permissionFuncionario->display_name = 'Usuarios Gesap';
        $permissionFuncionario->description = 'Permiso para el coordinador de deshabilitar un usuario';
        $permissionFuncionario->module_id = 7;
        $permissionFuncionario->save();
       

        //Fin de los permisos para e crud de Usuarios con el rol coordinador
    }
}
