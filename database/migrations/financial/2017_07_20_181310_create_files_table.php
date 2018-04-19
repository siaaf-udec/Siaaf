<?php

use App\Container\Financial\src\Constants\SchemaConstant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(SchemaConstant::CONNECTION)->create(SchemaConstant::FILES, function (Blueprint $table) {
            $table->increments(SchemaConstant::PRIMARY_KEY)
                    ->comment('Contiene el identificador del archivo.');
            $table->string(SchemaConstant::FILE_NAME)
                    ->comment('Campo que contiene el nombre original del archivo.');
            $table->string(SchemaConstant::FILE_ROUTE)
                    ->comment('Campo que contiene la ruta del archivo física en el servidor.');
            $table->unsignedTinyInteger(SchemaConstant::STATUS_FOREIGN_KEY)->nullable()
                    ->comment('Campo que contiene el estado de aceptación de los archivos.');
            $table->unsignedBigInteger(SchemaConstant::USER_FOREIGN_KEY)
                    ->comment('Campo que contiene el identificador del usuario que almacenó los archivos en el servidor.');
            $table->unsignedInteger(SchemaConstant::FILE_TYPE_FOREIGN_KEY)
                    ->comment('Campo que contiene el identificador del tipo de archivo al que pertenece, Icetex o Apoyo Financiero.');
            $table->timestamps();
            $table->softDeletes();
        });

        SchemaConstant::commentTable(
            SchemaConstant::FILES,
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
        Schema::dropIfExists(SchemaConstant::FILES);
    }
}
