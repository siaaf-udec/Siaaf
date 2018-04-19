<?php

use App\Container\Financial\src\SubjectProgram;
use Illuminate\Database\Seeder;

class SubjectsProgramsFinancialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory( SubjectProgram::class, 102 )->create();
    }
}