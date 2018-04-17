<?php

use App\Container\Financial\src\Constants\SchemaConstant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCostServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('financial')->create(SchemaConstant::COST_SERVICES, function (Blueprint $table) {
            $table->increments(SchemaConstant::PRIMARY_KEY)
                    ->comment('Campo que contiene el identificador del registro.');
            $table->float(SchemaConstant::COST, 10, 3)
                    ->comment('Campo que contiene el costo del supletorio.');
            $table->string(SchemaConstant::COST_SERVICE_NAME, 100)
                    ->comment('Campo que contiene el nombre del servicio o solicitud.');
            $table->dateTime( SchemaConstant::COST_VALID_UNTIL )
                    ->comment('Campo que determina el periodo válido del costo a aplicar.');
            $table->timestamps();
            $table->softDeletes();
        });

        SchemaConstant::commentTable(
            SchemaConstant::COST_SERVICES,
            'Tabla que contiene los costo de los servicios o solicitudes.', true);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(SchemaConstant::COST_SERVICES);
    }
}
