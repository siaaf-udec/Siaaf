<?php

use App\Container\Financial\src\Constants\SchemaConstant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(SchemaConstant::CONNECTION)->create(SchemaConstant::PROGRAM, function (Blueprint $table) {
            $table->increments(SchemaConstant::PRIMARY_KEY)
                    ->comment('Campo que contiene el identificador del registro.');
            $table->string(SchemaConstant::PROGRAM_NAME)
                    ->comment('Campo que contiene el nombre del programa.');
            $table->timestamps();
            $table->softDeletes();
        });
        SchemaConstant::commentTable(
            SchemaConstant::PROGRAM,
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
        Schema::dropIfExists(SchemaConstant::PROGRAM);
    }
}
