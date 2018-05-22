<?php

use App\Container\Permissions\src\Permission;
use Illuminate\Database\Seeder;
use app\Container\Permissions\src\Role;

class PermisosInteraccionSeeder extends Seeder
{

    public function run()
    {
         Permission::insert([
             
             ['name'=>'INTE_VER_NOTI_ADMIN',
             'display_name'=>'agregar con',
             'description'=>'premite al usuario la manipulación de los convenios',
             'module_id'=>'5'],
            ['name'=>'INTE_ADD_CONVENIO',
             'display_name'=>'agregar con',
             'description'=>'premite al usuario la manipulación de los convenios',
             'module_id'=>'5'],
             ['name'=>'INTE_EVA_EMPRESA',
             'display_name'=>'evalua Empresa',
             'description'=>'premite a la empresa evaluar',
             'module_id'=>'5'],
             ['name'=>'INTE_EVA_PASANTE',
             'display_name'=>'Evalua Pasante',
             'description'=>'premite al usuario evaluar una empresa',
             'module_id'=>'5'],
             ['name'=>'INTE_VER_EVA',
             'display_name'=>'ver resultados',
             'description'=>'premite al usuario ver los resultados de la evalucion',
             'module_id'=>'5'],
             ['name'=>'INTE_DES_DOC_CON',
             'display_name'=>'descargar arch',
             'description'=>'premite a los usuarios descargar archivos',
             'module_id'=>'5'],
            ['name'=>'INTE_MODULE',
             'display_name'=>'Modulo INTERACCION',
             'description'=>'Acceso a solo este modulo',
             'module_id'=>'5'],
             ['name'=>'INTE_VER_NOTI',
             'display_name'=>'ver notificacion',
             'description'=>'permite ver las notificaciones',
             'module_id'=>'5'],
             ['name'=>'INTE_VER_CONVENIO',
             'display_name'=>'ver convenios',
             'description'=>'Ver todos los convenios',
             'module_id'=>'5'],
             ['name'=>'INTE_VER_MIS_CON',
             'display_name'=>'ver mis convenios',
             'description'=>'ver los convenios en que participa',
             'module_id'=>'5'],
             ['name'=>'INTE_VER_EMPRESAS',
             'display_name'=>'ver empresas',
             'description'=>'permite ver todas las empresas',
             'module_id'=>'5'],
             ['name'=>'INTE_VER_SEDES',
             'display_name'=>'ver sedes',
             'description'=>'ver todas las sedes',
             'module_id'=>'5'],
             ['name'=>'INTE_VER_ESTADOS',
             'display_name'=>'ver estados',
             'description'=>'ver todos los estados ',
             'module_id'=>'5'],
             ['name'=>'INTE_VER_MIS_DOC',
             'display_name'=>'ver mis documentos',
             'description'=>'ver mis documentos',
             'module_id'=>'5'],
            ['name'=>'INTE_DES_DOC_USU',
             'display_name'=>'descargar documento usuario',
             'description'=>'ver mis documentos',
             'module_id'=>'5'],
             ['name'=>'INTE_VER_EVA_PRIN',
             'display_name'=>'ver evaluaciones',
             'description'=>'ver todas las evaluaciones',
             'module_id'=>'5'],
             ['name'=>'INTE_VER_TIPO_PREG',
             'display_name'=>'ver tipo preguntas',
             'description'=>'ver todos los tipos de pregunta',
             'module_id'=>'5'],
             ['name'=>'INTE_VER_PREG',
             'display_name'=>'ver preguntas',
             'description'=>'permite ver las preguntas de las encuestas',
             'module_id'=>'5'],
             ['name'=>'INTE_EDIT_CONVENIO',
             'display_name'=>'editar convenio',
             'description'=>'poder editar la informacion de un convenio',
             'module_id'=>'5'],
             ['name'=>'INTE_VER_DATO_CON',
             'display_name'=>'ver datos convenios',
             'description'=>'ver los datos de un convenio',
             'module_id'=>'5'],
             ['name'=>'INTE_ADD_DOC_CON',
             'display_name'=>'agregar documento convenio',
             'description'=>'permite agregar documentos al convenio',
             'module_id'=>'5'],
             ['name'=>'INTE_ADD_PARTI',
             'display_name'=>'agregar participante',
             'description'=>'--',
             'module_id'=>'5'],
             ['name'=>'INTE_ADD_EMP_PARTY',
             'display_name'=>'agregar empresa',
             'description'=>'--',
             'module_id'=>'5'],
             ['name'=>'INTE_EVA_PRE1',
             'display_name'=>'ver preguntas tipo 1',
             'description'=>'--',
             'module_id'=>'5'],
             ['name'=>'INTE_EVA_PRE2',
             'display_name'=>'ver preguntas tipo 2',
             'description'=>'--',
             'module_id'=>'5'],
             ['name'=>'INTE_EVA_PRE3',
             'display_name'=>'ver preguntas tipo 3',
             'description'=>'--',
             'module_id'=>'5'],
             ['name'=>'INTE_EVA_PRE4',
             'display_name'=>'ver preguntas tipo 4',
             'description'=>'--',
             'module_id'=>'5'],
             ['name'=>'INTE_DELET_PART',
             'display_name'=>'eliminar perticipantes',
             'description'=>'--',
             'module_id'=>'5']
        ]);
        
        $role1 = Role::where('name' , 'Admin_uni')->get(['id'])->first();
        $role2 = Role::where('name' , 'Coordinador_uni')->get(['id'])->first();
        $role3 = Role::where('name' , 'Funcionario_uni')->get(['id'])->first();
        $role4 = Role::where('name' , 'Pasante_uni')->get(['id'])->first();
        $role5 = Role::where('name' , 'Empresario_uni')->get(['id'])->first();
        
        
        
        
        //permisos para el pasante 
        $permission = Permission::where('name', '=', 'INTE_EVA_PASANTE')->first();
        $permission->roles()->attach($role4);
        $permission = Permission::where('name', '=', 'INTE_MODULE')->first();
        $permission->roles()->attach($role4);
        $permission = Permission::where('name', '=', 'INTE_VER_NOTI')->first();
        $permission->roles()->attach($role4);
        $permission = Permission::where('name', '=', 'INTE_VER_MIS_CON')->first();
        $permission->roles()->attach($role4);
        $permission = Permission::where('name', '=', 'INTE_VER_MIS_DOC')->first();
        $permission->roles()->attach($role4);
        $permission = Permission::where('name', '=', 'INTE_VER_DATO_CON')->first();
        $permission->roles()->attach($role4);
        $permission = Permission::where('name', '=', 'INTE_EVA_PRE4')->first();
        $permission->roles()->attach($role4);
        $permission = Permission::where('name', '=', 'INTE_DES_DOC_USU')->first();
        $permission->roles()->attach($role4);
        
        
        //permisos para las empresas
        $permission = Permission::where('name', '=', 'INTE_EVA_EMPRESA')->first();
         $permission->roles()->attach($role5);
        $permission = Permission::where('name', '=', 'INTE_DES_DOC_CON')->first();
         $permission->roles()->attach($role5);   
        $permission = Permission::where('name', '=', 'INTE_MODULE')->first();
         $permission->roles()->attach($role5);
        $permission = Permission::where('name', '=', 'INTE_VER_NOTI')->first();
         $permission->roles()->attach($role5); 
        $permission = Permission::where('name', '=', 'INTE_VER_MIS_CON')->first();
         $permission->roles()->attach($role5);
        $permission = Permission::where('name', '=', 'INTE_VER_MIS_DOC')->first();
         $permission->roles()->attach($role5); 
        $permission = Permission::where('name', '=', 'INTE_VER_DATO_CON')->first();
         $permission->roles()->attach($role5);
        $permission = Permission::where('name', '=', 'INTE_ADD_DOC_CON')->first();
         $permission->roles()->attach($role5); 
        $permission = Permission::where('name', '=', 'INTE_EVA_PRE2')->first();
         $permission->roles()->attach($role5);
        $permission = Permission::where('name', '=', 'INTE_DES_DOC_USU')->first();
         $permission->roles()->attach($role5); 
        
        //premisos para los coordinadores de programa
        $permission = Permission::where('name', '=', 'INTE_EVA_EMPRESA')->first();
        $permission->roles()->attach($role2);
        $permission = Permission::where('name', '=', 'INTE_DES_DOC_CON')->first();
        $permission->roles()->attach($role2);
        $permission = Permission::where('name', '=', 'INTE_MODULE')->first();
        $permission->roles()->attach($role2);
        $permission = Permission::where('name', '=', 'INTE_VER_NOTI')->first();
        $permission->roles()->attach($role2);
        $permission = Permission::where('name', '=', 'INTE_VER_MIS_CON')->first();
        $permission->roles()->attach($role2);
        $permission = Permission::where('name', '=', 'INTE_VER_MIS_DOC')->first();
        $permission->roles()->attach($role2);
        $permission = Permission::where('name', '=', 'INTE_VER_DATO_CON')->first();
        $permission->roles()->attach($role2);
        $permission = Permission::where('name', '=', 'INTE_ADD_DOC_CON')->first();
        $permission->roles()->attach($role2);
        $permission = Permission::where('name', '=', 'INTE_EVA_PRE2')->first();
        $permission->roles()->attach($role2);
        $permission = Permission::where('name', '=', 'INTE_DES_DOC_USU')->first();
        $permission->roles()->attach($role2);
        $permission = Permission::where('name', '=', 'INTE_EVA_PASANTE')->first();
        $permission->roles()->attach($role2);
        $permission = Permission::where('name', '=', 'INTE_EVA_PRE4')->first();
        $permission->roles()->attach($role2);
        
        //premisos para el funcionario 
        $permission = Permission::where('name', '=', 'INTE_ADD_CONVENIO')->first();
        $permission->roles()->attach($role3);
        $permission = Permission::where('name', '=', 'INTE_DES_DOC_CON')->first();
        $permission->roles()->attach($role3);
        $permission = Permission::where('name', '=', 'INTE_VER_EVA')->first();
        $permission->roles()->attach($role3);
        $permission = Permission::where('name', '=', 'INTE_MODULE')->first();
        $permission->roles()->attach($role3);
        $permission = Permission::where('name', '=', 'INTE_VER_NOTI')->first();
        $permission->roles()->attach($role3);
        $permission = Permission::where('name', '=', 'INTE_VER_CONVENIO')->first();
        $permission->roles()->attach($role3);
        $permission = Permission::where('name', '=', 'INTE_VER_EVA_PRIN')->first();
        $permission->roles()->attach($role3);
        $permission = Permission::where('name', '=', 'INTE_EDIT_CONVENIO')->first();
        $permission->roles()->attach($role3);
        $permission = Permission::where('name', '=', 'INTE_VER_DATO_CON')->first();
        $permission->roles()->attach($role3);
        $permission = Permission::where('name', '=', 'INTE_ADD_DOC_CON')->first();
        $permission->roles()->attach($role3);
        $permission = Permission::where('name', '=', 'INTE_ADD_PARTI')->first();
        $permission->roles()->attach($role3);
        $permission = Permission::where('name', '=', 'INTE_ADD_EMP_PARTY')->first();
        $permission->roles()->attach($role3);
        $permission = Permission::where('name', '=', 'INTE_DELET_PART')->first();
        $permission->roles()->attach($role3);
        $permission = Permission::where('name', '=', 'INTE_DES_DOC_USU')->first();
        $permission->roles()->attach($role3);
        $permission = Permission::where('name', '=', 'INTE_VER_EMPRESAS')->first();
        $permission->roles()->attach($role3);
        $permission = Permission::where('name', '=', 'MASTER_USERS')->first();
        $permission->roles()->attach($role3);
        
        //permisos para el administrador de interccion universitaria
        $permission = Permission::where('name', '=', 'INTE_ADD_CONVENIO')->first();
        $permission->roles()->attach($role1);
        $permission = Permission::where('name', '=', 'INTE_DES_DOC_CON')->first();
        $permission->roles()->attach($role1);
        $permission = Permission::where('name', '=', 'INTE_MODULE')->first();
        $permission->roles()->attach($role1);
        $permission = Permission::where('name', '=', 'INTE_VER_NOTI_ADMIN')->first();
        $permission->roles()->attach($role1);
        $permission = Permission::where('name', '=', 'INTE_VER_CONVENIO')->first();
        $permission->roles()->attach($role1);
        $permission = Permission::where('name', '=', 'INTE_EDIT_CONVENIO')->first();
        $permission->roles()->attach($role1);
        $permission = Permission::where('name', '=', 'INTE_VER_DATO_CON')->first();
        $permission->roles()->attach($role1);
        $permission = Permission::where('name', '=', 'INTE_ADD_DOC_CON')->first();
        $permission->roles()->attach($role1);
        $permission = Permission::where('name', '=', 'INTE_ADD_PARTI')->first();
        $permission->roles()->attach($role1);
        $permission = Permission::where('name', '=', 'INTE_ADD_EMP_PARTY')->first();
        $permission->roles()->attach($role1);
        $permission = Permission::where('name', '=', 'INTE_DELET_PART')->first();
        $permission->roles()->attach($role1);
        $permission = Permission::where('name', '=', 'INTE_DES_DOC_USU')->first();
        $permission->roles()->attach($role1);
        $permission = Permission::where('name', '=', 'INTE_VER_EMPRESAS')->first();
        $permission->roles()->attach($role1);
        $permission = Permission::where('name', '=', 'INTE_VER_SEDES')->first();
        $permission->roles()->attach($role1);
        $permission = Permission::where('name', '=', 'INTE_VER_ESTADOS')->first();
        $permission->roles()->attach($role1);
        $permission = Permission::where('name', '=', 'INTE_VER_MIS_DOC')->first();
        $permission->roles()->attach($role1);
        $permission = Permission::where('name', '=', 'INTE_VER_TIPO_PREG')->first();
        $permission->roles()->attach($role1);
        $permission = Permission::where('name', '=', 'INTE_VER_PREG')->first();
        $permission->roles()->attach($role1);
        $permission = Permission::where('name', '=', 'MASTER_USERS')->first();
        $permission->roles()->attach($role1);
        
    }
}
