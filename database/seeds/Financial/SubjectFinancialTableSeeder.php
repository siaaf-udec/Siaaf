<?php

namespace database\seeds\Financial;

use App\Container\Financial\src\Constants\SchemaConstant;
use App\Container\Financial\src\Subject;
use App\Container\Financial\src\SubjectProgram;
use Illuminate\Database\Seeder;

class SubjectFinancialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Subject::class, 100)->create();
    }
}