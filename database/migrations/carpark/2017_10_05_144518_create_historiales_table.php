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
        Schema::connection('carpark')->create('TBL_Carpark_Historiales', function (Blueprint $table) {
            $table->integer('PK_CH_IdHistorial')->unsigned()->unique()->primary();
            $table->String('CH_NombresUser', 100);
            $table->String('CH_CodigoUser');
            $table->String('CH_Placa', 6);
            $table->integer('CH_CodigoMoto')->unsigned();
            $table->datetime('CH_FHentrada');
            $table->timestamp('CH_FHsalida')->nullable();

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
        Schema::dropIfExists('TBL_Carpark_Historiales');
    }
}
