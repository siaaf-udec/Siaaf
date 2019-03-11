<?php

use App\Container\Permissions\src\Permission;
use \Illuminate\Database\Seeder;
use App\Container\Permissions\src\Role;

class PermissionGesapSeeder extends Seeder
{

    public function run()
    {

        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_MODULE';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'ACCESO A GESAP';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();

        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_DOCENTE';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'rol docente gesap.';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();

        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_STUDENT';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'rol ESTUDIANTE gesap.';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();

        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_ADMIN';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'rol ESTUDIANTE gesap.';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();

        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_ADMIN_MCT';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'GESTIONAR MCT.';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();

        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_ADMIN_CREATE_MCT';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'CREAR UN ANTEPROYECTO.';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();
        
        
        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_ADMIN_CREATE_ANTE';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'REPORTE TODOS LOS ANTEPROYECTO.';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();

        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_ADMIN_REPORT_ANTE_ALL';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'REPORTE TODOS LOS ANTEPROYECTO.';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();

        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_ADMIN_REPORT_ANTE';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'REPORTE UN ANTEPROYECTO.';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();

        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_ADMIN_UPDATE_ANTE';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'REPORTE UN ANTEPROYECTO.';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();

        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_ADMIN_VER_ANTE';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'VER UN ANTEPROYECTO.';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();

        
        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_ADMIN_CANCEL_ANTE';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'CANCELAR UN ANTEPROYECTO.';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();

        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_ADMIN_CANCEL';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'TODOS LOS BOTONES CANCELAR VOLVER, ETC DEL ROL ADMINISTRADOR.';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();

        
        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_ADMIN_SUBMIT';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'TODOS LOS BOTONES AFIRMAR, ETC DEL ROL ADMINISTRADOR.';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();

        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_ADMIN_ADD_DEVELOPER';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'AGREGAR UN DESARROLLADOR.';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();

        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_ADMIN_ADD_JUDMENT';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'AGREGAR UN JURADO.';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();

        
        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_ADMIN_CREATE_ACT_MCT';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'CREAR UNA ACTIVIDAD PARA EL MCT';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();
        
        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_ADMIN_FECHAS_MCT';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'ASIGNAR FECHAS AL ANTEPROYECTO.';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();

        
        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_ADMIN_DELETE_ACTIVIDAD_MCT';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'BORRAR ACTIVIDAD DEL MCT.';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();

        
        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_ADMIN_ADD_USER';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'AGREGAR UN USUARIO.';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();

        
        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_ADMIN_USER_REPORTS';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'DAR REPORTES DE TODOS LOS USUARIOS';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();

         
        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_ADMIN_USER_REPORT';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'DAR REPORTES DE TODOS LOS USUARIOS';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();
         
        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_ADMIN_CANCEL_USER';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'DAR EL USUARIO COMO INACTIVO';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();

        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_ADMIN_UPDATE_USER';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'DAR EL USUARIO COMO INACTIVO';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();
        
        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_ADMIN_ADD_DEVELOPER_VW';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'VER LOS DESARROLLADORES ACTIVOS';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();

        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_ADMIN_ADD_JUDMENT_VW';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'VER LOS JURADOS ACTIVOS';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();
        
        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_ADMIN_DELETE_DEVELOPER';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'CANCELAR DESARROLLADORES ACTIVOS';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();

        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_ADMIN_DELETE_JUDMENT';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'CANCELAR JURADOS ACTIVOS';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();

        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_ADMIN_VER_SOLICITUDES';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'VER SOLICITUDES HECHAS';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();

        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_ADMIN_FECHAS_SOLICITUDES';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'CAMBIAR FECHA SOLICITUD';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();

        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_ADMIN_ACT_LIBRO';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'AGREGAR UNA ACTIVIDAD';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();

        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_ADMIN_LIBRO_DATE';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'FECHAS PROYECTO';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();

        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_ADMIN_DELETE_ACTIVIDAD_LIBRO';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'BORRAR ACTIVIDAD LIBRO';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();

        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_ADMIN_REPORT_LIBROS';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'REPORTES DE TODOS LOS PROYECTOS';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();
        
        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_ADMIN_REPORT_LIBRO';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'REPORTE LIBRO';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();
        
        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_ADMIN_VER_LIBRO';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'VER LIBRO';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();
        
        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_ADMIN_LIBRO';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'GESTIONAR LIBRO';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();

        ///PERMISOS COORDINADOR
        
        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_DOCENTE_VER_REQ';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'VER REQ';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();
        
        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_DOCENTE_CANCEL';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'GESTIONAR LIBRO';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();
        
        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_DOCENTE_VER_ACT';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'VER ACTIVIDAD DOCENTE';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();
        
        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_DOCENTE_DECISION_JUDMENT';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'TOMAR DECISION DEL PROYECTO O ANTEPROYECTO';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();

        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_DOCENTE_SOLICITUD';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'CREAR UNA SOLICITUD';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();

        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_DOCENTE_MY_SOLICITUD';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'VER MIS SOLICITUD';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();
        
        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_DOCENTE_DELETE_SOL';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'CREAR UNA SOLICITUD';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();

        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_DOCENTE_VER_ANTE_DIRECTOR';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'VER ANTEPROYECTO COMO DIRECTOR';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();

        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_DOCENTE_VER_ANTE_JURADO';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'VER ANTEPROYECTO COMO DIRECTOR';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();


        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_DOCENTE_VER_PRO_DIRECTOR';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'VER PROYECTO COMO DIRECTOR';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();
        
        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_DOCENTE_VER_PRO_JURADO';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'VER ANTEPROYECTO COMO JURADO';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();

        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_DOCENTE_CALIFICAR_JURADO';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'VER ANTEPROYECTO COMO DIRECTOR';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();

        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_DOCENTE_VER_REQU';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'VER ANTEPROYECTO COMO DIRECTOR';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();

        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_DOCENTE_VER_ACTIVIDADES';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'VER ACTIVIDADES DEL MCT';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();

        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_DOCENTE_ASIGNAR_DESARROLLADORES';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'ASIGNAR DESARROLLADORES A UN PROYECTO';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();
        
        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_DOCENTE_COMENT';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'COMENTAR COMO DOCENTE';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();

        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_DOCENTE_APROBAR_ACTIVIDAD';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'VER ANTEPROYECTO COMO DIRECTOR';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();

        //PERMISOS DOCENTE

        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_STUDENT_VER_REQ';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'VER REQUERIMIENTOS';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();

        
        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_STUDENT_CANCEL';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'CANCELAR BOTON ESTUDIANTE';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();
        
        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_STUDENT_VER_ACTIVIDAD';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'VER ACTIVIDAD ESTUDIANTE';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();

        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_STUDENT_BANCO_PROYECTOS';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'VER BANCO DE PROYECTOS';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();

        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_STUDENT_SOLICITUDES';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'VER SOLICITUDES REALIZADAS';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();
        
        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_STUDENT_SOLICITUD';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'CREAR SOLICITUD';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();

        
        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_STUDENT_DELETE';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'ELIMINAR COMO ESTUDIANTE';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();
        
        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_STUDENT_FOLDER';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'VER ANTEPROYECTO O PROYECTO';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();

        
        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_STUDENT_VER_COMENTARIO_JURADO';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'VER COMENTARIO FINAL DEL JURADO PROYECTO O ANTEPROYECTO';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();

        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_STUDENT_RADICAR';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'RADICAR PROYECTO O ANTEPROYECTO';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();
        
        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_STUDENT_VER_ACTIVIDADES';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'VER ACTIVIDADES MCT';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();

        
        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_STUDENT_ADD_ACTIVIDAD';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'AGREGAR ACTIVIDAD';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();

        
        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_STUDENT_SUBMIT';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'ACEPTAR FORMULARIO';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();

        
        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_STUDENT_COMENT';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'HACER COMENTARIOS ';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();

        
        $permissioncoordinador = new Permission;
        $permissioncoordinador->name = 'GESAP_STUDENT_UPDATE';
        $permissioncoordinador->display_name = 'Gesap';
        $permissioncoordinador->description = 'MODIFICAR CAMPOS';
        $permissioncoordinador->module_id = 7;
        $permissioncoordinador->save();



















        












    }
}
