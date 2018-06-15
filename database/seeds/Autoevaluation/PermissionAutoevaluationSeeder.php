<?php

use App\Container\Permissions\Src\Permission;
<<<<<<< Updated upstream
use Illuminate\Database\Seeder;

class PermissionAcadspaceSeeder extends Seeder
=======
use \Illuminate\Database\Seeder;
use App\Container\Permissions\Src\Role;

class PermissionAutoevaluationSeeder extends Seeder
>>>>>>> Stashed changes
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
<<<<<<< Updated upstream
        $permission= new Permission;
        $permission->name = 'AUTO_MODULE';
        $permission->display_name = 'Autoevaluación';
        $permission->description = 'Acceso completo al modulo de autoevaluacion';
        $permission->module_id = 12;
        $permission ->save();

        $permission= new Permission;
        $permission->name = 'FUNC_AUTO';
        $permission->display_name = 'Autoevaluación';
        $permission->description = 'Acceso completo al modulo de autoevaluacion';
        $permission->module_id = 12;
        $permission ->save();

        $permission= new Permission;
        $permission->name = 'AUTO_ENCUESTAS';
        $permission->display_name = 'Encuestas';
        $permission->description = 'Acceso al menu de encuestas';
        $permission->module_id = 12;
        $permission ->save();

        $permission= new Permission;
        $permission->name = 'AUTO_REGISTRAR_ENCUESTAS';
        $permission->display_name = 'Registrar Encuestas';
        $permission->description = 'Acceso a registrar encuestas.';
        $permission->module_id = 12;
        $permission ->save();

        $permission= new Permission;
        $permission->name = 'AUTO_CONSULTAR_ENCUESTAS';
        $permission->display_name = 'Consultar Encuestas';
        $permission->description = 'Acceso a consultar las encuestas realizadas';
        $permission->module_id = 12;
        $permission ->save();

        $permission= new Permission;
        $permission->name = 'AUTO_DESCARGAR_FORMATO';
        $permission->display_name = 'Descargar Formatos';
        $permission->description = 'Acceso a descargar el archivo de encuestas realizadas';
        $permission->module_id = 12;
        $permission ->save();

        $permission= new Permission;
        $permission->name = 'AUTO_IMPORT_ENCUESTAS';
        $permission->display_name = 'Importar encuestas';
        $permission->description = 'Acceso a importar datos de encuestas';
        $permission->module_id = 12;
        $permission ->save();

        $permission= new Permission;
        $permission->name = 'AUTO_EDIT_ENCUESTAS';
        $permission->display_name = 'Editar encuestas';
        $permission->description = 'Acceso a editar los datos sobre encuestas.';
        $permission->module_id = 12;
        $permission ->save();

        $permission2= new Permission;
        $permission2->name = 'AUTO_EDIT_ENCUESTAS';
        $permission2->display_name = 'Eliminar datos sobre encuestas';
        $permission2->description = 'Acceso a eliminar datos sobre encuestas.';
        $permission2->module_id = 12;
        $permission2 ->save();

        $permission2= new Permission;
        $permission2->name = 'AUTO_FUENTES_PRIMARIAS';
        $permission2->display_name = 'Fuentes primarias';
        $permission2->description = 'Acceso al modulo fuentes primarias.';
        $permission2->module_id = 12;
        $permission2 ->save();

        $permission2= new Permission;
        $permission2->name = 'AUTO_FUENTES_SECUNDARIAS';
        $permission2->display_name = 'Fuentes secundarias';
        $permission2->description = 'Acceso al modulo fuentes secundarias.';
        $permission2->module_id = 12;
        $permission2 ->save();

        $permission2= new Permission;
        $permission2->name = 'AUTO_PREGUNTAS';
        $permission2->display_name = 'Registrar Preguntas';
        $permission2->description = 'Acceso a registrar preguntas.';
        $permission2->module_id = 12;
        $permission2 ->save();

        $permission2= new Permission;
        $permission2->name = 'AUTO_ELIMINAR_PREGUNTAS';
        $permission2->display_name = 'Eliminar Preguntas';
        $permission2->description = 'Acceso a eliminar preguntas.';
        $permission2->module_id = 12;
        $permission2 ->save();

        $permission2= new Permission;
        $permission2->name = 'AUTO_EDITAR_PREGUNTAS';
        $permission2->display_name = 'Editar preguntas';
        $permission2->description = 'Acceso a editar preguntas.';
        $permission2->module_id = 12;
        $permission2 ->save();

        $permission2= new Permission;
        $permission2->name = 'AUTO_CONSULTAR_PREGUNTAS';
        $permission2->display_name = 'Consultar menu preguntas';
        $permission2->description = 'Acceso al menu de preguntas.';
        $permission2->module_id = 12;
        $permission2 ->save();

        $permission2= new Permission;
        $permission2->name = 'AUTO_RESPUESTAS';
        $permission2->display_name = 'Registrar Tipo de respuestas';
        $permission2->description = 'Acceso a registrar tipo de respuestas.';
        $permission2->module_id = 12;
        $permission2 ->save();

        $permission2= new Permission;
        $permission2->name = 'AUTO_ELIMINAR_RESPUESTAS';
        $permission2->display_name = 'Eliminar Tipo de respuestas';
        $permission2->description = 'Acceso a eliminar tipo de respuestas.';
        $permission2->module_id = 12;
        $permission2 ->save();

        $permission2= new Permission;
        $permission2->name = 'AUTO_EDITAR_RESPUESTAS';
        $permission2->display_name = 'Editar Tipo de respuestas';
        $permission2->description = 'Acceso a editar tipo de respuestas.';
        $permission2->module_id = 12;
        $permission2 ->save();

        $permission2= new Permission;
        $permission2->name = 'AUTO_CONSULTAR_RESPUESTAS';
        $permission2->display_name = 'Consultar menu tipo de respuestas';
        $permission2->description = 'Acceso al menu de tipo de respuestas.';
        $permission2->module_id = 12;
        $permission2 ->save();


=======
        Permission::insert([
            ['name'=>'SUPERADMIN_MODULE',
                'display_name'=>'Modulo super administrador',
                'description'=>'Acceso al modulo super administrador',
                'module_id'=>'12'],
            ['name'=>'PRIMARY_SOURCE_MODULE',
                'display_name'=>'Modulo fuentes primarias',
                'description'=>'Acceso al modulo fuentes primarias',
                'module_id'=>'12'],
            ['name'=>'SECONDARY_SOURCES_MODULE',
                'display_name'=>'Modulo fuentes secundarias',
                'description'=>'Acceso al modulo fuentes secundarias',
                'module_id'=>'12'],
            ['name'=>'See_All_Dependences_Autoevaluation',
                'display_name'=>'Ver todas las dependencias',
                'description'=>'Observar en una tabla las dependencias que se encuentran en el sistema',
                'module_id'=>'12'],
            ['name'=>'Create_Dependence_Autoevaluation',
                'display_name'=>'Crear Dependencia',
                'description'=>'Creacion de nuevas dependencias documentales',
                'module_id'=>'12'],
            ['name'=>'Modify_Dependence_Autoevaluation',
                'display_name'=>'Modificar dependencia',
                'description'=>'Modificar dependencia documental',
                'module_id'=>'12']
            ,
            ['name'=>'Delete_Dependence_Autoevaluation',
                'display_name'=>'Eliminar dependencia',
                'description'=>'Eliminar dependencia documental',
                'module_id'=>'12'],
        ]);

        $role1 = Role::where('name' , 'SuperAdmin_Autoevaluation')->get(['id'])->first();
        $role2 = Role::where('name' , 'PrimarySource_Autoevaluation')->get(['id'])->first();
        $role3 = Role::where('name' , 'SecondarySource_Autoevaluation')->get(['id'])->first();

        $permission = Permission::where('name', '=', 'SUPERADMIN_MODULE')->first();
        $permission->roles()->attach($role1);
        $permission = Permission::where('name', '=', 'PRIMARY_SOURCE_MODULE')->first();
        $permission->roles()->attach($role1);
        $permission->roles()->attach($role2);
        $permission = Permission::where('name', '=', 'SECONDARY_SOURCES_MODULE')->first();
        $permission->roles()->attach($role1);
        $permission->roles()->attach($role3);
        $permission = Permission::where('name', '=', 'See_All_Dependences_Autoevaluation')->first();
        $permission->roles()->attach($role1);
        $permission->roles()->attach($role2);
        $permission->roles()->attach($role3);
        $permission = Permission::where('name', '=', 'Create_Dependence_Autoevaluation')->first();
        $permission->roles()->attach($role3);
        $permission = Permission::where('name', '=', 'Modify_Dependence_Autoevaluation')->first();
        $permission->roles()->attach($role3);
        $permission = Permission::where('name', '=', 'Delete_Dependence_Autoevaluation')->first();
        $permission->roles()->attach($role3);
>>>>>>> Stashed changes
    }
}
