<?php

use App\Container\Financial\src\Constants\SchemaConstant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddSubSubjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(SchemaConstant::CONNECTION )->create(SchemaConstant::ADD_SUB_SUBJECTS, function (Blueprint $table) {
            $table->increments(SchemaConstant::PRIMARY_KEY)
                    ->comment('Campo que contiene el identificador del registro.');
            $table->unsignedTinyInteger(SchemaConstant::ACTION_SUBJECT)
                    ->comment('Campo que determina si se añade o se cancela una materia');
            $table->dateTime(SchemaConstant::APPROVAL_DATE)->nullable()
                ->comment('Campo que contiene la fecha de aprobación');
            $table->unsignedInteger(SchemaConstant::SUBJECT_FOREIGN_KEY)
                    ->comment('Campo que contiene identificador de la materia');
            $table->unsignedBigInteger(SchemaConstant::STUDENT_FOREIGN_KEY)
                    ->comment('Campo que contiene identificación del estudiante');
            $table->unsignedInteger(SchemaConstant::STATUS_FOREIGN_KEY)
                    ->comment('Campo que contiene el identificador del estado de la aprobación');
            $table->unsignedInteger(SchemaConstant::COST_FOREIGN_KEY)
                    ->comment('Contiene el identificador del costo asociado a la solicitud');
            $table->unsignedBigInteger(SchemaConstant::APPROVED_BY)->nullable()
                ->comment('Campo que indica usuario que realiza la aprobación de la solicitud');
            $table->timestamps();
            $table->softDeletes();
        });

        SchemaConstant::commentTable(SchemaConstant::ADD_SUB_SUBJECTS, 'Tabla que contiene información los estudiantes y las materias añadidas o canceladas.', true);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(SchemaConstant::ADD_SUB_SUBJECTS);
    }
}
