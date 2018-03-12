<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngresosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('carpark')->create('TBL_Carpark_Ingresos', function (Blueprint $table) {
            $table->integer('PK_CI_IdIngreso')->unsigned()->unique()->primary();
            $table->String('CI_NombresUser', 100);
            $table->integer('CI_CodigoUser')->unsigned();
            $table->String('CI_Placa', 6);
            $table->integer('CI_CodigoMoto')->unsigned();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TBL_Carpark_Ingresos');
    }
}
