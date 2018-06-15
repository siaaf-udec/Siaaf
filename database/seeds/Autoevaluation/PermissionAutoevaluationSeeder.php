<?php

use App\Container\Permissions\Src\Permission;
use Illuminate\Database\Seeder;

class PermissionAcadspaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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


    }
}
