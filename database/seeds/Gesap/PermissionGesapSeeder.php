<?php

use App\Container\Permissions\Src\Permission;
use \Illuminate\Database\Seeder;
use App\Container\Permissions\Src\Role;

class PermissionGesapSeeder extends Seeder
{

    public function run()
    {
        Permission::insert([
            ['name'=>'SEE_ALL_PROJECT_GESAP',
             'display_name'=>'Ver todos los Anteproyectos y los proyectos',
             'description'=>'Listar todos los anteproyectos y proyectos creados en la plataforma',
             'module_id'=>'7'],
            ['name'=>'CREATE_PROJECT_GESAP',
             'display_name'=>'Crear Anteproyecto',
             'description'=>'Creacion de nuevos anteproyectos y sus documentos',
             'module_id'=>'7'],
            ['name'=>'MODIFY_PROJECT_GESAP',
             'display_name'=>'Modificar Anteproyectos',
             'description'=>'Modificar o actualizar los datos de un anteproyecto previo',
             'module_id'=>'7'],
            ['name'=>'DELETE_PROJECT_GESAP',
             'display_name'=>'Eliminar Anteproyecto',
             'description'=>'Eliminacion de anteproyectos y sus documentos',
             'module_id'=>'7'],
            ['name'=>'ASSIGN_TEACHER_GESAP',
             'display_name'=>'Asignar Docentes',
             'description'=>'Asignacion de directores y jurados a los anteproyectos existentes',
             'module_id'=>'7'],
            ['name'=>'REPORT_GESAP',
             'display_name'=>'Ver Reportes',
             'description'=>'Ver los reportes',
             'module_id'=>'7'],
            ['name'=>'CREATE_ACTIVITY_DEFAULT_GESAP',
             'display_name'=>'Actividades',
             'description'=>'Actividades default',
             'module_id'=>'7'],
            ['name'=>'EDIT_ACTIVITY_DEFAULT_GESAP',
             'display_name'=>'Actividades',
             'description'=>'Actividades default',
             'module_id'=>'7'],
            ['name'=>'DELETE_ACTIVITY_DEFAULT_GESAP',
             'display_name'=>'Actividades',
             'description'=>'Actividades default',
             'module_id'=>'7'],

            ['name'=>'JURY_LIST_GESAP',
             'display_name'=>'Proyectos de Jurado',
             'description'=>'Listar los proyectos asignados al usuario como jurado',
             'module_id'=>'7'],
            ['name'=>'CREATE_OBSERVATIONS_GESAP',
             'display_name'=>'Crear Observaciones',
             'description'=>'Crear las observaciones a un anteproyecto en especifico',
             'module_id'=>'7'],
            ['name'=>'CREATE_CONCEPT_GESAP',
             'display_name'=>'Crear Concepto',
             'description'=>'Calificacion por concepto a un anteproytecto en especifico',
             'module_id'=>'7'],

            ['name'=>'DIRECTOR_LIST_GESAP',
             'display_name'=>'Proyectos de Director',
             'description'=>'Listar los proyectos asignados al usuario como director',
             'module_id'=>'7'],
            ['name'=>'CLOSE_PROJECT_GESAP',
             'display_name'=>'Terminacion de proyecto',
             'description'=>'Cierre del proyecto dando por terminado el mismo',
             'module_id'=>'7'],
            ['name'=>'APROVED_PROJECT_GESAP',
             'display_name'=>'Habilitar Proyecto',
             'description'=>'Activar el proyecto cuando este aprobado el anteproyecto,habilita actividades',
             'module_id'=>'7'],
            ['name'=>'CREATE_ACTIVITY_GESAP',
             'display_name'=>'Crear actividades',
             'description'=>'Crear nuevas actividades de proyecto',
             'module_id'=>'7'],
            ['name'=>'Delete_Activity_Gesap',
             'display_name'=>'Eliminar actividades',
             'description'=>'Eliminar actividades de proyecto',
             'module_id'=>'7'],
            ['name'=>'STUDENT_LIST_GESAP',
             'display_name'=>'Proyectos de Estudiante',
             'description'=>'Listar los proyectos asignados al usuario como Estudiante',
             'module_id'=>'7'],

            ['name'=>'SEE_OBSERVATIONS_GESAP',
             'display_name'=>'Ver Observaciones',
             'description'=>'Ver las observaciones realizadas al proyecto en especifico',
             'module_id'=>'7'],
            ['name'=>'SEE_ACTIVITY_GESAP',
             'display_name'=>'Ver Observaciones',
             'description'=>'Ver las observaciones realizadas al proyecto en especifico',
             'module_id'=>'7'],
            ['name'=>'UPDATE_FINAL_PROJECT_GESAP',
             'display_name'=>'Subir Archivos de Proyecto',
             'description'=>'Subida de archivos para el proyecto final',
             'module_id'=>'7'],

            ['name'=>'GESAP_MODULE',
             'display_name'=>'Modulo GESAP',
             'description'=>'Acceso a solo este modulo',
             'module_id'=>'7']
        ]);

        $role1 = Role::where('name' , 'Coordinator_Gesap')->get(['id'])->first();
        $role2 = Role::where('name' , 'Evaluator_Gesap')->get(['id'])->first();
        $role3 = Role::where('name' , 'Student_Gesap')->get(['id'])->first();

        $permission = Permission::where('name', '=', 'GESAP_MODULE')->first();
        $permission->roles()->attach($role1);
        $permission = Permission::where('name', '=', 'GESAP_MODULE')->first();
        $permission->roles()->attach($role2);
        $permission = Permission::where('name', '=', 'GESAP_MODULE')->first();
        $permission->roles()->attach($role3);

        $permission = Permission::where('name', '=', 'SEE_ALL_PROJECT_GESAP')->first();
        $permission->roles()->attach($role1);
        $permission = Permission::where('name', '=', 'CREATE_PROJECT_GESAP')->first();
        $permission->roles()->attach($role1);
        $permission = Permission::where('name', '=', 'MODIFY_PROJECT_GESAP')->first();
        $permission->roles()->attach($role1);
        $permission = Permission::where('name', '=', 'DELETE_PROJECT_GESAP')->first();
        $permission->roles()->attach($role1);
        $permission = Permission::where('name', '=', 'ASSIGN_TEACHER_GESAP')->first();
        $permission->roles()->attach($role1);
        $permission = Permission::where('name', '=', 'REPORT_GESAP')->first();
        $permission->roles()->attach($role1);
        $permission = Permission::where('name', '=', 'CREATE_ACTIVITY_DEFAULT_GESAP')->first();
        $permission->roles()->attach($role1);
        $permission = Permission::where('name', '=', 'EDIT_ACTIVITY_DEFAULT_GESAP')->first();
        $permission->roles()->attach($role1);
        $permission = Permission::where('name', '=', 'DELETE_ACTIVITY_DEFAULT_GESAP')->first();
        $permission->roles()->attach($role1);

        $permission = Permission::where('name', '=', 'JURY_LIST_GESAP')->first();
        $permission->roles()->attach($role1);
        $permission = Permission::where('name', '=', 'JURY_LIST_GESAP')->first();
        $permission->roles()->attach($role2);

        $permission = Permission::where('name', '=', 'CREATE_OBSERVATIONS_GESAP')->first();
        $permission->roles()->attach($role1);
        $permission = Permission::where('name', '=', 'CREATE_OBSERVATIONS_GESAP')->first();
        $permission->roles()->attach($role2);
        $permission = Permission::where('name', '=', 'CREATE_CONCEPT_GESAP')->first();
        $permission->roles()->attach($role1);
        $permission = Permission::where('name', '=', 'CREATE_CONCEPT_GESAP')->first();
        $permission->roles()->attach($role2);

        $permission = Permission::where('name', '=', 'DIRECTOR_LIST_GESAP')->first();
        $permission->roles()->attach($role1);
        $permission = Permission::where('name', '=', 'DIRECTOR_LIST_GESAP')->first();
        $permission->roles()->attach($role2);
        $permission = Permission::where('name', '=', 'CLOSE_PROJECT_GESAP')->first();
        $permission->roles()->attach($role1);
        $permission = Permission::where('name', '=', 'CLOSE_PROJECT_GESAP')->first();
        $permission->roles()->attach($role2);
        $permission = Permission::where('name', '=', 'APROVED_PROJECT_GESAP')->first();
        $permission->roles()->attach($role1);
        $permission = Permission::where('name', '=', 'APROVED_PROJECT_GESAP')->first();
        $permission->roles()->attach($role2);
        $permission = Permission::where('name', '=', 'CREATE_ACTIVITY_GESAP')->first();
        $permission->roles()->attach($role1);
        $permission = Permission::where('name', '=', 'CREATE_ACTIVITY_GESAP')->first();
        $permission->roles()->attach($role2);
        $permission = Permission::where('name', '=', 'Delete_Activity_Gesap')->first();
        $permission->roles()->attach($role1);
        $permission = Permission::where('name', '=', 'Delete_Activity_Gesap')->first();
        $permission->roles()->attach($role2);

        $permission = Permission::where('name', '=', 'STUDENT_LIST_GESAP')->first();
        $permission->roles()->attach($role3);
        $permission = Permission::where('name', '=', 'UPDATE_FINAL_PROJECT_GESAP')->first();
        $permission->roles()->attach($role3);

        $permission = Permission::where('name', '=', 'SEE_OBSERVATIONS_GESAP')->first();
        $permission->roles()->attach($role1);
        $permission = Permission::where('name', '=', 'SEE_OBSERVATIONS_GESAP')->first();
        $permission->roles()->attach($role2);
        $permission = Permission::where('name', '=', 'SEE_OBSERVATIONS_GESAP')->first();
        $permission->roles()->attach($role3);
        $permission = Permission::where('name', '=', 'SEE_ACTIVITY_GESAP')->first();
        $permission->roles()->attach($role1);
        $permission = Permission::where('name', '=', 'SEE_ACTIVITY_GESAP')->first();
        $permission->roles()->attach($role2);
        $permission = Permission::where('name', '=', 'SEE_ACTIVITY_GESAP')->first();
        $permission->roles()->attach($role3);

        $permission = Permission::where('name', '=', 'MASTER_USERS')->first();
        $permission->roles()->attach($role1);
    }
}
