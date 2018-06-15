<?php

use App\Container\Permissions\Src\Permission;
use \Illuminate\Database\Seeder;
use App\Container\Permissions\Src\Role;

class PermissionAutoevaluationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
    }
}
