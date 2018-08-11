<?php
/**
 * Copyright (c) 2017 - 2017. Todos los derechos reservados. Ley N° 23 de 1982 Colombia.
 */

/**
 * Created by PhpStorm.
 * User: Daniel Prado
 * Date: 21/07/2017
 * Time: 11:28 AM
 */

use Illuminate\Database\Seeder;

class DatabaseAutoevaluationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleAutoevaluationSeeder::class);
        $this->call(PermissionAutoevaluationSeeder::class);
        $this->call(UsersAutoevaluationSeeder::class);
    }
}