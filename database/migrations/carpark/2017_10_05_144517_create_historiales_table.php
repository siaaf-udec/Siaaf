<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('carpark')->create('TBL_Carpark_historiales', function (Blueprint $table) {
            $table->integer('PK_CH_IdHistoia')->unsigned()->unique()->primary();
            $table->integer('FK_CH_Ingreso')->unsigned();
            $table->integer('FK_CH_IdMoto');
            $table->string('CH_Placa', 6);
            $table->foreign('FK_CH_Ingreso')->references('PK_CU_Codigo')->on('TBL_Carpark_usuarios');
            $table->foreign('FK_CH_IdMoto')->references('PK_CM_IdMoto')->on('TBL_Carpark_motos');
            $table->datetime('CH_FHentrada');
            $table->timestamp('CH_FHsalida')->default(DB::raw('CURRENT_TIMESTAMP'));

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
        Schema::dropIfExists('TBL_Carpark_historiales');
    }
}
