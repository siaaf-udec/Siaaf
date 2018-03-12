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

class PermissionHumTalentSeeder extends Seeder
{

    public function run ()
    {
        //permiso general para el rol
        $permission= new Permission;
        $permission->name = 'TAL_MODULE';
        $permission->display_name = 'HumTalent';
        $permission->description = 'Acceso completo a la modulo de recursos humanos.';
        $permission->module_id = 6;
        $permission ->save();

        //Inicio para crear los permisos para los crud de empleados.

        $permission= new Permission;
        $permission->name = 'TAL_CREATE_EMP';
        $permission->display_name = 'Crear Empleado';
        $permission->description = 'Permiso para registrar empleados';
        $permission->module_id = 6;
        $permission ->save();

        $permission= new Permission;
        $permission->name = 'TAL_READ_EMP';
        $permission->display_name = 'Leer Empleado';
        $permission->description = 'Permiso para consultar empleados';
        $permission->module_id = 6;
        $permission ->save();

        $permission= new Permission;
        $permission->name = 'TAL_UPDATE_EMP';
        $permission->display_name = 'Actualizar Empleado';
        $permission->description = 'Permiso para actualizar empleados';
        $permission->module_id = 6;
        $permission ->save();

        $permission= new Permission;
        $permission->name = 'TAL_DELETE_EMP';
        $permission->display_name = 'Borrar Empleado';
        $permission->description = 'Permiso para eliminar empleados';
        $permission->module_id = 6;
        $permission ->save();

        //permiso para enviar correos a los empleados.
        $permission= new Permission;
        $permission->name = 'TAL_SEND_EMAIL';
        $permission->display_name = 'Enviar Correo';
        $permission->description = 'Permiso para eliminar empleados';
        $permission->module_id = 6;
        $permission ->save();

        //permisos para el CRUD de documentos.
        $permission= new Permission;
        $permission->name = 'TAL_CREATE_DOC';
        $permission->display_name = 'Crear Documento';
        $permission->description = 'Permiso para registrar documentos';
        $permission->module_id = 6;
        $permission ->save();

        $permission= new Permission;
        $permission->name = 'TAL_READ_DOC';
        $permission->display_name = 'Leer Documento';
        $permission->description = 'Permiso para consultar documentos';
        $permission->module_id = 6;
        $permission ->save();

        $permission= new Permission;
        $permission->name = 'TAL_UPDATE_DOC';
        $permission->display_name = 'Actualizar Documento';
        $permission->description = 'Permiso para actualizar documentos';
        $permission->module_id = 6;
        $permission ->save();

        $permission= new Permission;
        $permission->name = 'TAL_DELETE_DOC';
        $permission->display_name = 'Borrar Documento';
        $permission->description = 'Permiso para eliminar documentos';
        $permission->module_id = 6;
        $permission ->save();

        //permisos para el CRUD de eventos.
        $permission= new Permission;
        $permission->name = 'TAL_CREATE_EVENT';
        $permission->display_name = 'Crear Evento';
        $permission->description = 'Permiso para registrar eventos';
        $permission->module_id = 6;
        $permission ->save();

        $permission= new Permission;
        $permission->name = 'TAL_READ_EVENT';
        $permission->display_name = 'Leer Evento';
        $permission->description = 'Permiso para consultar eventos';
        $permission->module_id = 6;
        $permission ->save();

        $permission= new Permission;
        $permission->name = 'TAL_UPDATE_EVENT';
        $permission->display_name = 'Actualizar Evento';
        $permission->description = 'Permiso para actualizar eventos';
        $permission->module_id = 6;
        $permission ->save();

        $permission= new Permission;
        $permission->name = 'TAL_DELETE_EVENT';
        $permission->display_name = 'Borrar Evento';
        $permission->description = 'Permiso para eliminar eventos';
        $permission->module_id = 6;
        $permission ->save();

        //permisos para realizar inducción .
        $permission= new Permission;
        $permission->name = 'TAL_CREATE_IND';
        $permission->display_name = 'Realizar Inducción';
        $permission->description = 'Permiso para realizar inducción';
        $permission->module_id = 6;
        $permission ->save();

        //permisos para el CRUD de permisos o incapacidades.
        $permission= new Permission;
        $permission->name = 'TAL_CREATE_PERM';
        $permission->display_name = 'Crear Permiso';
        $permission->description = 'Permiso para registrar incapacidades';
        $permission->module_id = 6;
        $permission ->save();

        $permission= new Permission;
        $permission->name = 'TAL_READ_PERM';
        $permission->display_name = 'Leer permiso';
        $permission->description = 'Permiso para consultar incapacidades';
        $permission->module_id = 6;
        $permission ->save();

        $permission= new Permission;
        $permission->name = 'TAL_UPDATE_PERM';
        $permission->display_name = 'Actualizar Permiso';
        $permission->description = 'Permiso para actualizar incapacidades';
        $permission->module_id = 6;
        $permission ->save();

        $permission= new Permission;
        $permission->name = 'TAL_DELETE_PERM';
        $permission->display_name = 'Borrar Permiso';
        $permission->description = 'Permiso para eliminar incapacidades';
        $permission->module_id = 6;
        $permission ->save();


        //permisos para generar reportes.
        $permission= new Permission;
        $permission->name = 'TAL_GEN_REPORT';
        $permission->display_name = 'Generar reporte';
        $permission->description = 'Permiso para generar reportes';
        $permission->module_id = 6;
        $permission ->save();

        //permisos para radicar documentos.
        $permission= new Permission;
        $permission->name = 'TAL_RAD_DOC';
        $permission->display_name = 'Radicar Documentos';
        $permission->description = 'Permiso para radicar documentos';
        $permission->module_id = 6;
        $permission ->save();


    }
}