<?php

use App\Container\Financial\src\Program;
use App\Container\Financial\src\Subject;
use App\Container\Financial\src\SubjectProgram;
use App\Container\Users\Src\User;
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
        $teacher = User::select( 'id' )->where('email', 'teacher@app.com')->first();
        if ( isset( $teacher->id ) ) {
            /*
             * Relation Subject, Program and Teacher
             */
            SubjectProgram::create([
                teacher_fk()    =>  $teacher->id,
                program_fk()    =>  factory( Program::class )->create([
                    program_name()  =>  'Ingeniería de Sistemas'
                ])->{ primaryKey() },
                subject_fk()    =>  factory( Subject::class )->create([
                    subject_name()  =>  'Materia de Prueba'
                ])->{ primaryKey() },
            ]);
        }
    }
}