<?php

use App\Container\Permissions\Src\Permission;
use \App\Container\Permissions\Src\Module;
use Illuminate\Database\Seeder;

class PermissionFinancialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $module = Module::where( 'name', 'Financiero' )->select( 'id' )->first();

        if ( isset( $module->id ) ) {
            Permission::create([
                'name'          =>  'FINAN_MODULE',
                'display_name'  =>  'Módulo Financiero',
                'description'   =>  'Permite acceder a las herramientas del módulo financero.',
                'module_id'     =>  $module->id,
            ]);
        }
    }
}