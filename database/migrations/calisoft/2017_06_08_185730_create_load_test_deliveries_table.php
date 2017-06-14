<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoadTestDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_EntregaPruebaCarga', function (Blueprint $table) {
            $table->increments('PK_id');
            $table->integer('numero');
            $table->boolean('approved')->nullable();
            $table->text('observacion')->nullable();
            $table->text('tiempos');
            $table->integer('FK_PruebaCargaId')->unsigned();
            $table->timestamps();

            $table->foreign('FK_PruebaCargaId')->references('PK_id')->on('TBL_PruebaCarga')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TBL_EntregaPruebaCarga');
    }
}
