<?php

use App\Container\Financial\src\Constants\SchemaConstant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectProgramTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(SchemaConstant::CONNECTION)->create(SchemaConstant::SUBJECT_PROGRAM, function (Blueprint $table) {
            $table->unsignedInteger(SchemaConstant::SUBJECT_FOREIGN_KEY)
                    ->comment('Campo que contiene el identificador de la materia.');
            $table->unsignedInteger(SchemaConstant::PROGRAM_FOREIGN_KEY)
                    ->comment('Campo que contiene la identificación del programa.');
            $table->unsignedBigInteger(SchemaConstant::TEACHER_FOREIGN_KEY)
                    ->comment('Campo que contiene la identificación del profesor que tiene acargo la materia.');
            $table->primary([SchemaConstant::SUBJECT_FOREIGN_KEY, SchemaConstant::PROGRAM_FOREIGN_KEY, SchemaConstant::TEACHER_FOREIGN_KEY]);
        });
        SchemaConstant::commentTable(
            SchemaConstant::SUBJECT_PROGRAM,
            'Tabla que relaciona las materias con los profesores y programas.');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(SchemaConstant::SUBJECT_PROGRAM);
    }
}
