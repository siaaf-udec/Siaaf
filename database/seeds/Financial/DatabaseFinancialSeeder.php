<?php
/**
 * Copyright (c) 2017. Todos los derechos reservados. Ley N° 23 de 1982 Colombia.
 */

/**
 * Created by PhpStorm.
 * User: Daniel Prado
 * Date: 21/07/2017
 * Time: 11:28 AM
 */

use database\seeds\Financial\ProgramFinancialTableSeeder;
use database\seeds\Financial\SubjectFinancialTableSeeder;
use Illuminate\Database\Seeder;

class DatabaseFinancialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesFinancialTableSeeder::class);
        $this->call(UsersFinancialTableSeeder::class);
        //$this->call(ProgramFinancialTableSeeder::class);
        //$this->call(SubjectFinancialTableSeeder::class);
        //$this->call(SubjectsProgramsFinancialTableSeeder::class);
    }
}