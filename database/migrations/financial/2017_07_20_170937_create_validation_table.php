<?php

use App\Container\Financial\src\Constants\SchemaConstant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateValidationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(SchemaConstant::CONNECTION)->create(SchemaConstant::VALIDATION, function (Blueprint $table) {
            $table->increments(SchemaConstant::PRIMARY_KEY)
                    ->comment('Campo que contiene el identificador del registro.');
            $table->dateTime(SchemaConstant::REALIZATION_DATE)->nullable()
                    ->comment('Fecha en que realizará la respectiva validación.');
            $table->dateTime(SchemaConstant::APPROVAL_DATE)->nullable()
                    ->comment('Campo que contiene la fecha de aprobación.');
            $table->unsignedInteger(SchemaConstant::SUBJECT_FOREIGN_KEY)
                    ->comment('Campo que contiene identificación de la materia a validar.');
            $table->unsignedInteger(SchemaConstant::STATUS_FOREIGN_KEY)
                    ->comment('Campo que contiene identificador del estado de la validación.');
            $table->unsignedInteger(SchemaConstant::COST_FOREIGN_KEY)
                    ->comment('Campo que contiene el identificador del costo del servicio.');
            $table->unsignedBigInteger(SchemaConstant::STUDENT_FOREIGN_KEY)
                    ->comment('Campo que contiene el identificador del estudiante que desea realizar la validacón.');
            $table->unsignedBigInteger(SchemaConstant::APPROVED_BY)->nullable()
                ->comment('Campo que indica usuario que realiza la aprobación de la solicitud.');
            $table->timestamps();
            $table->softDeletes();
        });

        SchemaConstant::commentTable(
            SchemaConstant::VALIDATION,
            'Tabla que contiene las solicitudes de validaciones de los estudiantes.',
            true);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(SchemaConstant::VALIDATION);
    }
}
