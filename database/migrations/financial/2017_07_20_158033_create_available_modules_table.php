<?php

use App\Container\Financial\src\Constants\SchemaConstant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvailableModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(SchemaConstant::CONNECTION )->create(SchemaConstant::AVAILABLE_MODULES , function (Blueprint $table) {
            $table->increments(SchemaConstant::PRIMARY_KEY)
                    ->comment('Campo que contiene el identificador del registro.');
            $table->string( SchemaConstant::MODULE_NAME )
                    ->comment('Campo que contiene el nombre del módulo.');
            $table->dateTime( SchemaConstant::AVAILABLE_FROM )
                    ->comment('Campo que contiene la fecha inicial de disponibilidad del módulo.');
            $table->dateTime( SchemaConstant::AVAILABLE_UNTIL )
                    ->comment('Campo que contiene la fecha final de disponibilidad del módulo.');
            $table->timestamps();
            $table->softDeletes();
        });

        SchemaConstant::commentTable(
            SchemaConstant::AVAILABLE_MODULES,
            'Tabla que contiene la fecha de disponibilidad de los módulos.',
            true);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(SchemaConstant::AVAILABLE_MODULES);
    }
}
