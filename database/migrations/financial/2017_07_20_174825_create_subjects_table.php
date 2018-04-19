<?php

use App\Container\Financial\src\Constants\SchemaConstant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(SchemaConstant::CONNECTION)->create(SchemaConstant::SUBJECTS, function (Blueprint $table) {
            $table->increments(SchemaConstant::PRIMARY_KEY)
                    ->comment('Campo que contiene el identificador del registro.');
            $table->string(SchemaConstant::SUBJECT_CODE, 50)
                    ->comment('Campo que contiene el código de la materia');
            $table->string(SchemaConstant::SUBJECT_NAME)
                    ->comment('Campo que contiene el nombre de la materia');
            $table->unsignedTinyInteger(SchemaConstant::SUBJECT_CREDITS)
                    ->comment('Campo que contiene los créditos correspondientes a una materia');
            $table->timestamps();
            $table->softDeletes();
        });
        SchemaConstant::commentTable(
            SchemaConstant::SUBJECTS,
            'Tabla que contiene los programas de la extensión Facatatativá.',
            true);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(SchemaConstant::SUBJECTS);
    }
}
