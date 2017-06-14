<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_EntregaPrueba', function (Blueprint $table) {
            $table->increments('PK_id');
            $table->integer('numero');
            $table->boolean('approved')->nullable();
            $table->text('observacion')->nullable();
            $table->integer('FK_PruebasId')->unsigned();
            $table->timestamps();

            $table->foreign('FK_PruebasId')->references('PK_id')->on('TBL_Pruebas')
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
        Schema::dropIfExists('TBL_EntregaPrueba');
    }
}
