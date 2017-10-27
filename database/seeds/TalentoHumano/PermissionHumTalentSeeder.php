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
        $permission->name = 'FUNC_RRHH';
        $permission->display_name = 'HumTalent';
        $permission->description = 'Acceso completo a la modulo de recursos humanos.';
        $permission->module_id = 6;
        $permission ->save();

        //Inicio para crear los permisos para los crud de empleados.

        $permission= new Permission;
        $permission->name = 'CREATE_EMP_RRHH';
        $permission->display_name = 'HumTalent';
        $permission->description = 'Permiso para registrar empleados';
        $permission->module_id = 6;
        $permission ->save();

        $permission= new Permission;
        $permission->name = 'READ_EMP_RRHH';
        $permission->display_name = 'HumTalent';
        $permission->description = 'Permiso para consultar empleados';
        $permission->module_id = 6;
        $permission ->save();

        $permission= new Permission;
        $permission->name = 'UPDATE_EMP_RRHH';
        $permission->display_name = 'HumTalent';
        $permission->description = 'Permiso para actualizar empleados';
        $permission->module_id = 6;
        $permission ->save();

        $permission= new Permission;
        $permission->name = 'DELETE_EMP_RRHH';
        $permission->display_name = 'HumTalent';
        $permission->description = 'Permiso para eliminar empleados';
        $permission->module_id = 6;
        $permission ->save();

        //permiso para enviar correos a los empleados.
        $permission= new Permission;
        $permission->name = 'SEND_EMAIL_RRHH';
        $permission->display_name = 'HumTalent';
        $permission->description = 'Permiso para eliminar empleados';
        $permission->module_id = 6;
        $permission ->save();

        //permisos para el CRUD de documentos.
        $permission= new Permission;
        $permission->name = 'CREATE_DOC_RRHH';
        $permission->display_name = 'HumTalent';
        $permission->description = 'Permiso para registrar documentos';
        $permission->module_id = 6;
        $permission ->save();

        $permission= new Permission;
        $permission->name = 'READ_DOC_RRHH';
        $permission->display_name = 'HumTalent';
        $permission->description = 'Permiso para consultar documentos';
        $permission->module_id = 6;
        $permission ->save();

        $permission= new Permission;
        $permission->name = 'UPDATE_DOC_RRHH';
        $permission->display_name = 'HumTalent';
        $permission->description = 'Permiso para actualizar documentos';
        $permission->module_id = 6;
        $permission ->save();

        $permission= new Permission;
        $permission->name = 'DELETE_DOC_RRHH';
        $permission->display_name = 'HumTalent';
        $permission->description = 'Permiso para eliminar documentos';
        $permission->module_id = 6;
        $permission ->save();

        //permisos para el CRUD de eventos.
        $permission= new Permission;
        $permission->name = 'CREATE_EVENT_RRHH';
        $permission->display_name = 'HumTalent';
        $permission->description = 'Permiso para registrar eventos';
        $permission->module_id = 6;
        $permission ->save();

        $permission= new Permission;
        $permission->name = 'READ_EVENT_RRHH';
        $permission->display_name = 'HumTalent';
        $permission->description = 'Permiso para consultar eventos';
        $permission->module_id = 6;
        $permission ->save();

        $permission= new Permission;
        $permission->name = 'UPDATE_EVENT_RRHH';
        $permission->display_name = 'HumTalent';
        $permission->description = 'Permiso para actualizar eventos';
        $permission->module_id = 6;
        $permission ->save();

        $permission= new Permission;
        $permission->name = 'DELETE_EVENT_RRHH';
        $permission->display_name = 'HumTalent';
        $permission->description = 'Permiso para eliminar eventos';
        $permission->module_id = 6;
        $permission ->save();

        //permisos para realizar inducción .
        $permission= new Permission;
        $permission->name = 'CREATE_IND_RRHH';
        $permission->display_name = 'HumTalent';
        $permission->description = 'Permiso para realizar inducción';
        $permission->module_id = 6;
        $permission ->save();

        //permisos para el CRUD de permisos o incapacidades.
        $permission= new Permission;
        $permission->name = 'CREATE_PERM_RRHH';
        $permission->display_name = 'HumTalent';
        $permission->description = 'Permiso para registrar incapacidades';
        $permission->module_id = 6;
        $permission ->save();

        $permission= new Permission;
        $permission->name = 'READ_PERM_RRHH';
        $permission->display_name = 'HumTalent';
        $permission->description = 'Permiso para consultar incapacidades';
        $permission->module_id = 6;
        $permission ->save();

        $permission= new Permission;
        $permission->name = 'UPDATE_PERM_RRHH';
        $permission->display_name = 'HumTalent';
        $permission->description = 'Permiso para actualizar incapacidades';
        $permission->module_id = 6;
        $permission ->save();

        $permission= new Permission;
        $permission->name = 'DELETE_PERM_RRHH';
        $permission->display_name = 'HumTalent';
        $permission->description = 'Permiso para eliminar incapacidades';
        $permission->module_id = 6;
        $permission ->save();


        //permisos para generar reportes.
        $permission= new Permission;
        $permission->name = 'GEN_REPORT_RRHH';
        $permission->display_name = 'HumTalent';
        $permission->description = 'Permiso para generar reportes';
        $permission->module_id = 6;
        $permission ->save();

        //permisos para radicar documentos.
        $permission= new Permission;
        $permission->name = 'RAD_DOC_RRHH';
        $permission->display_name = 'HumTalent';
        $permission->description = 'Permiso para radicar documentos';
        $permission->module_id = 6;
        $permission ->save();


    }
}