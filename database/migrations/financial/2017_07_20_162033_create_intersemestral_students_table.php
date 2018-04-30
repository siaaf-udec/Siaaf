<?php

use App\Container\Financial\src\Constants\SchemaConstant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntersemestralStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(SchemaConstant::CONNECTION )->create(SchemaConstant::INTERSEMESTRAL_STUDENT , function (Blueprint $table) {
            $table->increments(SchemaConstant::PRIMARY_KEY)
                    ->comment('Campo que contiene el identificador del registro.');
            $table->unsignedInteger(SchemaConstant::INTERSEMESTRAL_FOREIGN_KEY)
                    ->comment('Campo que contiene el identificador del intersemestral al que se inscribieron');
            $table->unsignedInteger(SchemaConstant::STUDENT_FOREIGN_KEY)
                    ->comment('Campo que identifica al estudiantes inscrito en el intersemestral');
            $table->boolean( SchemaConstant::PAID )
                    ->comment('Campo que identifica si el estudiante pagó el intersemestral.');
            $table->timestamps();
            $table->softDeletes();
        });

        SchemaConstant::commentTable(
            SchemaConstant::INTERSEMESTRAL_STUDENT,
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
        Schema::dropIfExists(SchemaConstant::INTERSEMESTRAL_STUDENT);
    }
}
