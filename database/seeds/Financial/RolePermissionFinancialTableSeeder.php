<?php

use App\Container\Financial\src\Constants\ConstantPermissions;
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

        $root = new Role;
        $root->name         = $roles[4]['name'];
        $root->display_name = $roles[4]['display_name'];
        $root->description  = $roles[4]['description'];
        $root->save();

        if ( !isset( $module->id ) ) {
            $module = new Module;
            $module->name   =   'Financiero';
            $module->description   =   'Financiero';
            $module->save();
            $module = Module::where( 'name', 'Financiero' )->select( 'id' )->first();
        }

        $permission = ConstantPermissions::getModulePermission( 'financial_module' );
        $financial = new Permission;
        $financial->name         = $permission['name'];
        $financial->display_name = $permission['display_name'];
        $financial->description  = $permission['description'];
        $financial->module_id    =  $module->id;
        $financial->save();

        $permission = ConstantPermissions::getModulePermission( 'resource_management' );
        $resources = new Permission;
        $resources->name         = $permission['name'];
        $resources->display_name = $permission['display_name'];
        $resources->description  = $permission['description'];
        $resources->module_id    =  $module->id;
        $resources->save();

        $permission = ConstantPermissions::getModulePermission( 'resource_management', 'programs' );
        $programs = new Permission;
        $programs->name         = $permission['name'];
        $programs->display_name = $permission['display_name'];
        $programs->description  = $permission['description'];
        $programs->module_id    =  $module->id;
        $programs->save();

        $permission = ConstantPermissions::getModulePermission( 'resource_management', 'subjects' );
        $subjects = new Permission;
        $subjects->name         = $permission['name'];
        $subjects->display_name = $permission['display_name'];
        $subjects->description  = $permission['description'];
        $subjects->module_id    =  $module->id;
        $subjects->save();

        $permission = ConstantPermissions::getModulePermission( 'resource_management', 'costs' );
        $costs = new Permission;
        $costs->name         = $permission['name'];
        $costs->display_name = $permission['display_name'];
        $costs->description  = $permission['description'];
        $costs->module_id    =  $module->id;
        $costs->save();

        $permission = ConstantPermissions::getModulePermission( 'resource_management', 'status' );
        $status = new Permission;
        $status->name         = $permission['name'];
        $status->display_name = $permission['display_name'];
        $status->description  = $permission['description'];
        $status->module_id    =  $module->id;
        $status->save();

        $permission = ConstantPermissions::getModulePermission( 'resource_management', 'file_types' );
        $file_types = new Permission;
        $file_types->name         = $permission['name'];
        $file_types->display_name = $permission['display_name'];
        $file_types->description  = $permission['description'];
        $file_types->module_id    =  $module->id;
        $file_types->save();

        $permission = ConstantPermissions::getModulePermission( 'files_management' );
        $files_management = new Permission;
        $files_management->name         = $permission['name'];
        $files_management->display_name = $permission['display_name'];
        $files_management->description  = $permission['description'];
        $files_management->module_id    =  $module->id;
        $files_management->save();

        $permission = ConstantPermissions::getModulePermission( 'files_management', 'upload_files' );
        $upload_files = new Permission;
        $upload_files->name         = $permission['name'];
        $upload_files->display_name = $permission['display_name'];
        $upload_files->description  = $permission['description'];
        $upload_files->module_id    =  $module->id;
        $upload_files->save();

        $permission = ConstantPermissions::getModulePermission( 'files_management', 'approve_files' );
        $approve_files = new Permission;
        $approve_files->name         = $permission['name'];
        $approve_files->display_name = $permission['display_name'];
        $approve_files->description  = $permission['description'];
        $approve_files->module_id    =  $module->id;
        $approve_files->save();

        $permission = ConstantPermissions::getModulePermission( 'request_management' );
        $request_management = new Permission;
        $request_management->name         = $permission['name'];
        $request_management->display_name = $permission['display_name'];
        $request_management->description  = $permission['description'];
        $request_management->module_id    =  $module->id;
        $request_management->save();

        $permission = ConstantPermissions::getModulePermission( 'request_management', 'extension' );
        $extension = new Permission;
        $extension->name         = $permission['name'];
        $extension->display_name = $permission['display_name'];
        $extension->description  = $permission['description'];
        $extension->module_id    =  $module->id;
        $extension->save();

        $permission = ConstantPermissions::getModulePermission( 'request_management', 'validation' );
        $validation = new Permission;
        $validation->name         = $permission['name'];
        $validation->display_name = $permission['display_name'];
        $validation->description  = $permission['description'];
        $validation->module_id    =  $module->id;
        $validation->save();

        $permission = ConstantPermissions::getModulePermission( 'request_management', 'add_sub' );
        $add_sub = new Permission;
        $add_sub->name         = $permission['name'];
        $add_sub->display_name = $permission['display_name'];
        $add_sub->description  = $permission['description'];
        $add_sub->module_id    =  $module->id;
        $add_sub->save();

        $permission = ConstantPermissions::getModulePermission( 'request_management', 'intersemestral' );
        $intersemestral = new Permission;
        $intersemestral->name         = $permission['name'];
        $intersemestral->display_name = $permission['display_name'];
        $intersemestral->description  = $permission['description'];
        $intersemestral->module_id    =  $module->id;
        $intersemestral->save();

        $permission = ConstantPermissions::getModulePermission( 'approval_management' );
        $approval_management = new Permission;
        $approval_management->name         = $permission['name'];
        $approval_management->display_name = $permission['display_name'];
        $approval_management->description  = $permission['description'];
        $approval_management->module_id    =  $module->id;
        $approval_management->save();

        $permission = ConstantPermissions::getModulePermission( 'approval_management', 'extension' );
        $extension_approval = new Permission;
        $extension_approval->name         = $permission['name'];
        $extension_approval->display_name = $permission['display_name'];
        $extension_approval->description  = $permission['description'];
        $extension_approval->module_id    =  $module->id;
        $extension_approval->save();

        $permission = ConstantPermissions::getModulePermission( 'approval_management', 'validation' );
        $validation_approval = new Permission;
        $validation_approval->name         = $permission['name'];
        $validation_approval->display_name = $permission['display_name'];
        $validation_approval->description  = $permission['description'];
        $validation_approval->module_id    =  $module->id;
        $validation_approval->save();

        $permission = ConstantPermissions::getModulePermission( 'approval_management', 'add_sub' );
        $add_sub_approval = new Permission;
        $add_sub_approval->name         = $permission['name'];
        $add_sub_approval->display_name = $permission['display_name'];
        $add_sub_approval->description  = $permission['description'];
        $add_sub_approval->module_id    =  $module->id;
        $add_sub_approval->save();

        $permission = ConstantPermissions::getModulePermission( 'approval_management', 'intersemestral' );
        $intersemestral_approval = new Permission;
        $intersemestral_approval->name         = $permission['name'];
        $intersemestral_approval->display_name = $permission['display_name'];
        $intersemestral_approval->description  = $permission['description'];
        $intersemestral_approval->module_id    =  $module->id;
        $intersemestral_approval->save();

        /*
         * Root permissions
         */
        $root_permissions = [
            $financial,
            //
            $resources,
            $programs,
            $subjects,
            $costs,
            $status,
            $file_types,
            //
            $files_management,
            $upload_files,
            $approve_files,
            //
            $request_management,
            $extension,
            $validation,
            $add_sub,
            $intersemestral,
            //
            $approval_management,
            $extension_approval,
            $validation_approval,
            $add_sub_approval,
            $intersemestral_approval,
        ];

        /*
         * Admin permissions
         */
        $admin_permissions = [
            $financial,
            //
            $resources,
            $programs,
            $subjects,
            $costs,
            $status,
            $file_types,
            //
            $files_management,
            $approve_files,
            //
            $approval_management,
            $extension_approval,
            $validation_approval,
            $add_sub_approval,
            $intersemestral_approval,
        ];

        /*
         * Student permissions
         */
        $student_permissions = [
            $financial,
            $files_management,
            $upload_files,
            $request_management,
            $extension,
            $validation,
            $add_sub,
            $intersemestral,
        ];

        /*
         * Secretary permissions
         */
        $secretary_permissions = [
            $financial,
            $resources,
            $programs,
            $subjects,
            $approval_management,
            $extension_approval,
            $validation_approval,
            $add_sub_approval,
            $intersemestral_approval,
        ];

        /*
         * Attach Permission to Role
         */
        $root->attachPermission( $root_permissions );
        $admin->attachPermission( $admin_permissions );
        $teacher->attachPermission( $financial );
        $student->attachPermission( $student_permissions );
        $secretary->attachPermission( $secretary_permissions );
    }
}