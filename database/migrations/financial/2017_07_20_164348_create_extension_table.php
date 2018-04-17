<?php

use App\Container\Financial\src\Constants\SchemaConstant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtensionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(SchemaConstant::CONNECTION )->create(SchemaConstant::EXTENSION, function (Blueprint $table) {
            $table->increments(SchemaConstant::PRIMARY_KEY)
                    ->comment('Campo que contiene el identificador del registro.');
            $table->dateTime(SchemaConstant::APPROVAL_DATE)->nullable()
                    ->comment('Campo que contiene la fecha de aprobación');
            $table->dateTime(SchemaConstant::REALIZATION_DATE)->nullable()
                    ->comment('Campo que contiene la fecha y la hora en que se realizará el supletorio');
            $table->unsignedInteger(SchemaConstant::SUBJECT_FOREIGN_KEY)
                    ->comment('Campo que contiene el identificador de la materia');
            $table->unsignedBigInteger(SchemaConstant::STUDENT_FOREIGN_KEY)
                    ->comment('Campo que contiene el estudiante que solicita el supletorio');
            $table->unsignedBigInteger(SchemaConstant::APPROVED_BY)->nullable()
                ->comment('Campo que indica usuario que realiza la aprobación de la solicitud');
            $table->unsignedInteger(SchemaConstant::STATUS_FOREIGN_KEY)
                    ->comment('Campo que contiene el identificador del estado asociado a la solicitud');
            $table->unsignedInteger(SchemaConstant::COST_FOREIGN_KEY)
                    ->comment('Campo que contiene el identificador del costo asociado a la solicitud');
            $table->timestamps();
            $table->softDeletes();
        });

        SchemaConstant::commentTable(SchemaConstant::EXTENSION, 'Tabla que contiene los supletorios solicitados.', true);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(SchemaConstant::EXTENSION);
    }
}
