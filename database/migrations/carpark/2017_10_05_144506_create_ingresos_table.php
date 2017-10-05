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
        Schema::connection('carpark')->create('TBL_Carpark_ingresos', function (Blueprint $table) {
            $table->integer('PK_CI_IdIngreso')->unsigned()->unique()->primary();
            $table->integer('CI_Ingreso')->unsigned();
            $table->integer('FK_CI_IdMoto');
            $table->foreign('FK_CI_IdMoto')->references('PK_CM_IdMoto')->on('TBL_Carpark_motos');

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
        Schema::dropIfExists('TBL_Carpark_ingresos');
    }
}
