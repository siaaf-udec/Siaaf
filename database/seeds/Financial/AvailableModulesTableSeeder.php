<?php

use App\Container\Financial\src\AvailableModules;
use Illuminate\Database\Seeder;

class AvailableModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modules = [
            [
                module_name()       =>  status_type_file(),
                available_from()    =>  today(),
                available_until()   =>  today()->addDay(),
            ],
            [
                module_name()       =>  status_type_extension(),
                available_from()    =>  today(),
                available_until()   =>  today()->addDay(),
            ],
            [
                module_name()       =>  status_type_validation(),
                available_from()    =>  today(),
                available_until()   =>  today()->addDay(),
            ],
            [
                module_name()       =>  status_type_intersemestral(),
                available_from()    =>  today(),
                available_until()   =>  today()->addDay(),
            ],
            [
                module_name()       =>  status_type_addition_subtraction(),
                available_from()    =>  today(),
                available_until()   =>  today()->addDay(),
            ],
        ];
        foreach ( $modules as $module ) {
            AvailableModules::create( $module );
        }
    }
}