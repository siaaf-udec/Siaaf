<?php

use App\Container\Financial\src\Constants\SchemaConstant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(SchemaConstant::CONNECTION)->create(SchemaConstant::REQUEST_STATUS, function (Blueprint $table) {
            $table->increments(SchemaConstant::PRIMARY_KEY)
                    ->comment('Campo que contiene el identificador del registro.');
            $table->string(SchemaConstant::STATUS_NAME, 100)
                    ->comment('Campo que contiene el nombre del estado');
            $table->string(SchemaConstant::STATUS_TYPE, 100)
                    ->comment('Campo que contiene el nombre del tipo de estado al que pertenece.');
            $table->timestamps();
            $table->softDeletes();
        });

        SchemaConstant::commentTable(
            SchemaConstant::REQUEST_STATUS,
            'Tabla que contiene los estados de las solicitudes en general.',
            true);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(SchemaConstant::REQUEST_STATUS);
    }
}
