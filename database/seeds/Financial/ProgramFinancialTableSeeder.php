<?php

use App\Container\Financial\src\Constants\SchemaConstant;
use App\Container\Financial\src\Program;
use Illuminate\Database\Seeder;

class ProgramFinancialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $programs = [
          [SchemaConstant::PROGRAM_NAME => 'Administración de Empresas'],
          [SchemaConstant::PROGRAM_NAME => 'Contaduría Pública'],
          [SchemaConstant::PROGRAM_NAME => 'Ingeniería de Sistemas'],
          [SchemaConstant::PROGRAM_NAME => 'Ingeniería Agronómica'],
          [SchemaConstant::PROGRAM_NAME => 'Ingeniería Ambiental'],
          [SchemaConstant::PROGRAM_NAME => 'Psicología'],
        ];

        foreach ($programs as $program) {
            Program::create($program);
        }
    }
}