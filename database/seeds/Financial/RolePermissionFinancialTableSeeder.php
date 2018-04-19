<?php

use App\Container\Financial\src\Constants\ConstantRoles;
use App\Container\Permissions\Src\Module;
use App\Container\Permissions\Src\Permission;
use App\Container\Permissions\Src\Role;
use Illuminate\Database\Seeder;

class RolePermissionFinancialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ConstantRoles::getRoles();
        $module = Module::where( 'name', 'Financiero' )->select( 'id' )->first();

        $admin = new Role;
        $admin->name         = $roles[0]['name'];
        $admin->display_name = $roles[0]['display_name'];
        $admin->description  = $roles[0]['description'];
        $admin->save();

        $teacher = new Role;
        $teacher->name         = $roles[1]['name'];
        $teacher->display_name = $roles[1]['display_name'];
        $teacher->description  = $roles[1]['description'];
        $teacher->save();

        $student = new Role;
        $student->name         = $roles[2]['name'];
        $student->display_name = $roles[2]['display_name'];
        $student->description  = $roles[2]['description'];
        $student->save();

        $secretary = new Role;
        $secretary->name         = $roles[3]['name'];
        $secretary->display_name = $roles[3]['display_name'];
        $secretary->description  = $roles[3]['description'];
        $secretary->save();

        if ( !isset( $module->id ) ) {
            $module = new Module;
            $module->name   =   'Financiero';
            $module->description   =   'Financiero';
            $module->save();
            $module = Module::where( 'name', 'Financiero' )->select( 'id' )->first();
        }

        $financial = new Permission;
        $financial->name         = 'FINAN_MODULE';
        $financial->display_name = 'Módulo Financiero';
        $financial->description  = 'Permite acceder a las herramientas del módulo financero.';
        $financial->module_id    =  $module->id;
        $financial->save();

        $admin->attachPermission( $financial );
        $teacher->attachPermission( $financial );
        $student->attachPermission( $financial );
        $secretary->attachPermission( $financial );
    }
}