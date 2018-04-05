<?php

use App\Container\Permissions\Src\Permission;
use Illuminate\Database\Seeder;

class PermisosInteraccionSeeder extends Seeder
{

    public function run()
    {
         Permission::insert([
            ['name'=>'Add_Convenio',
             'display_name'=>'agregar con',
             'description'=>'premite al usuario la manipulación de los convenios',
             'module_id'=>'5'],
             ['name'=>'Eva_Empresa',
             'display_name'=>'evalua Empresa',
             'description'=>'premite a la empresa evaluar',
             'module_id'=>'5'],
             ['name'=>'Eva_Pasante',
             'display_name'=>'Evalua Pasante',
             'description'=>'premite al usuario evaluar una empresa',
             'module_id'=>'5'],
             ['name'=>'Ver_Eva',
             'display_name'=>'ver resultados',
             'description'=>'premite al usuario ver los resultados de la evalucion',
             'module_id'=>'5'],
             ['name'=>'Des_Doc_Con',
             'display_name'=>'descargar arch',
             'description'=>'premite a los usuarios descargar archivos',
             'module_id'=>'5'],
            ['name'=>'INTE_MODULE',
             'display_name'=>'Modulo INTERACCION',
             'description'=>'Acceso a solo este modulo',
             'module_id'=>'5'],
             ['name'=>'Ver_noti',
             'display_name'=>'ver notificacion',
             'description'=>'permite ver las notificaciones',
             'module_id'=>'5'],
             ['name'=>'Ver_Convenio',
             'display_name'=>'ver convenios',
             'description'=>'Ver todos los convenios',
             'module_id'=>'5'],
             ['name'=>'Ver_mis_Con',
             'display_name'=>'ver mis convenios',
             'description'=>'ver los convenios en que participa',
             'module_id'=>'5'],
             ['name'=>'Ver_empresas',
             'display_name'=>'ver empresas',
             'description'=>'permite ver todas las empresas',
             'module_id'=>'5'],
             ['name'=>'Ver_sedes',
             'display_name'=>'ver sedes',
             'description'=>'ver todas las sedes',
             'module_id'=>'5'],
             ['name'=>'Ver_estados',
             'display_name'=>'ver estados',
             'description'=>'ver todos los estados ',
             'module_id'=>'5'],
             ['name'=>'Ver_mis_doc',
             'display_name'=>'ver mis documentos',
             'description'=>'ver mis documentos',
             'module_id'=>'5'],
             ['name'=>'Ver_eva_prin',
             'display_name'=>'ver evaluaciones',
             'description'=>'ver todas las evaluaciones',
             'module_id'=>'5'],
             ['name'=>'Ver_tipo_preg',
             'display_name'=>'ver tipo preguntas',
             'description'=>'ver todos los tipos de pregunta',
             'module_id'=>'5'],
             ['name'=>'Ver_preg',
             'display_name'=>'ver preguntas',
             'description'=>'permite ver las preguntas de las encuestas',
             'module_id'=>'5'],
             ['name'=>'Edit_Convenio',
             'display_name'=>'editar convenio',
             'description'=>'poder editar la informacion de un convenio',
             'module_id'=>'5'],
             ['name'=>'Ver_dato_con',
             'display_name'=>'ver datos convenios',
             'description'=>'ver los datos de un convenio',
             'module_id'=>'5'],
             ['name'=>'Add_doc_con',
             'display_name'=>'agregar documento convenio',
             'description'=>'permite agregar documentos al convenio',
             'module_id'=>'5'],
             ['name'=>'Add_parti',
             'display_name'=>'agregar participante',
             'description'=>'--',
             'module_id'=>'5'],
             ['name'=>'Add_emp_parti',
             'display_name'=>'agregar empresa',
             'description'=>'--',
             'module_id'=>'5'],
             ['name'=>'Eva_pre1',
             'display_name'=>'ver preguntas tipo 1',
             'description'=>'--',
             'module_id'=>'5'],
             ['name'=>'Eva_pre2',
             'display_name'=>'ver preguntas tipo 2',
             'description'=>'--',
             'module_id'=>'5'],
             ['name'=>'Eva_pre3',
             'display_name'=>'ver preguntas tipo 3',
             'description'=>'--',
             'module_id'=>'5'],
             ['name'=>'Eva_pre4',
             'display_name'=>'ver preguntas tipo 4',
             'description'=>'--',
             'module_id'=>'5'],
        ]);
        
        $permission = Permission::where('name', '=', 'INTE_MODULE')->first();
        $permission->roles('Admin_uni')->sync(2);
        $permission->roles('Coordinador_uni')->sync(3);
        $permission->roles('Funcionario_uni')->sync(4);
        $permission->roles('Pasante_uni')->sync(5);
        $permission->roles('Empresario_uni')->sync(6);
        
        //permisos para el administrador de interccion universitaria
        $permission = Permission::where('name', '=', 'Add_Convenio')->first();
        $permission->roles('Admin_uni')->sync(2);
        $permission = Permission::where('name', '=', 'Des_Doc_Con')->first();
        $permission->roles('Admin_uni')->sync(2);
        $permission = Permission::where('name', '=', 'Ver_Eva')->first();
        $permission->roles('Admin_uni')->sync(2);
        //permisos para el pasante 
        $permission = Permission::where('name', '=', 'Eva_Pasante')->first();
        $permission->roles('Pasante_uni')->sync(5);
        //premisos para el funcionario 
        $permission = Permission::where('name', '=', 'Add_Convenio')->first();
        $permission->roles('Funcionario_uni')->sync(4);
        $permission = Permission::where('name', '=', 'Des_Doc_Con')->first();
        $permission->roles('Funcionario_uni')->sync(4);
        $permission = Permission::where('name', '=', 'Ver_Eva')->first();
        $permission->roles('Funcionario_uni')->sync(4);
        //premisos para los coordinadores de programa
        $permission = Permission::where('name', '=', 'Eva_Pasante')->first();
        $permission->roles('Coordinador_uni')->sync(3);
        $permission = Permission::where('name', '=', 'Des_Doc_Con')->first();
        $permission->roles('Coordinador_uni')->sync(3);
        $permission = Permission::where('name', '=', 'Eva_Empresa')->first();
        $permission->roles('Coordinador_uni')->sync(3);
        //permisos para las empresas
        $permission = Permission::where('name', '=', 'Eva_Empresa')->first();
        $permission->roles('Empresario_uni')->sync(6);
        $permission = Permission::where('name', '=', 'Des_Doc_Con')->first();
        $permission->roles('Empresario_uni')->sync(6);        
    }
}
