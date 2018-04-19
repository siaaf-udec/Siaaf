<?php

use App\Container\Financial\src\Constants\SchemaConstant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('financial')->create(SchemaConstant::FILE_TYPE, function (Blueprint $table) {
            $table->increments(SchemaConstant::PRIMARY_KEY)
                    ->comment('Campo que contiene el identificador de la materia.');
            $table->string(SchemaConstant::FILE_TYPE, 50)
                    ->comment('Campo que contiene el tipo de archivo al que pertenece, Icetex o Apoyo Financiero.');
            $table->timestamps();
            $table->softDeletes();
        });
        SchemaConstant::commentTable(
            SchemaConstant::FILE_TYPE,
            'Tabla que almacenará la ruta de los archivos asociados a un estudiante, pueden ser de Icetex o de Apoyo Financiero.',
            true);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('file_types');
    }
}
