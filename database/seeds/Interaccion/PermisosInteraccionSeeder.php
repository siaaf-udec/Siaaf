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
            
        ]);
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
