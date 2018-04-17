<?php

use App\Container\Financial\src\Constants\SchemaConstant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntersemestralTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(SchemaConstant::CONNECTION )->create(SchemaConstant::INTERSEMESTRAL, function (Blueprint $table) {
            $table->increments(SchemaConstant::PRIMARY_KEY)
                    ->comment('Campo que contiene el identificador del registro.');
            $table->dateTime(SchemaConstant::APPROVAL_DATE)->nullable()
                    ->comment('Campo que contiene la fecha de aprobación');
            $table->dateTime(SchemaConstant::REALIZATION_DATE)->nullable()
                ->comment('Campo que contiene la fecha y la hora en que se realizará el intersementral');
            $table->unsignedInteger(SchemaConstant::STATUS_FOREIGN_KEY)
                    ->comment('Campo que contiene el identificador del estado de la aprobación');
            $table->unsignedInteger(SchemaConstant::SUBJECT_FOREIGN_KEY)
                    ->comment('Campo que identifica las materias disponibles para el intersemestral');
            $table->unsignedInteger(SchemaConstant::COST_FOREIGN_KEY)
                    ->comment('Campo que cotiene el identificador del costo del servicio.');
            $table->unsignedBigInteger(SchemaConstant::APPROVED_BY)->nullable()
                    ->comment('Campo que indica usuario que realiza la aprobación de la solicitud');
            $table->timestamps();
            $table->softDeletes();
        });
        SchemaConstant::commentTable(
            SchemaConstant::INTERSEMESTRAL,
            'Tabla que contiene los estudiantes interesados en realizar el intersemestral.',
            true);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(SchemaConstant::INTERSEMESTRAL );
    }
}
