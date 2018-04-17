<?php

use App\Container\Financial\src\Constants\ConstantRoles;
use App\Container\Permissions\Src\Role;
use Illuminate\Database\Seeder;

class RolesFinancialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (ConstantRoles::getRoles() as $role) {
            Role::create($role);
        }
    }
}