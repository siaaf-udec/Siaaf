<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('audiovisuals')->create('TBL_Articulos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('FK_ART_Tipo_id')->unsigned()->nullable();
            $table->String('ART_Descripcion');
            $table->integer('FK_ART_Kit_id')->unsigned()->nullable();
            $table->integer('FK_ART_Estado_id')->unsigned()->nullable();
            $table->String('ART_Codigo');

            $table->timestamps();

            $table->foreign('FK_ART_Tipo_id')->references('id')->on('TBL_Tipo_articulos');

            $table->foreign('FK_ART_Kit_id')->references('id')->on('TBL_Kits');

            $table->foreign('FK_ART_Estado_id')->references('id')->on('TBL_Estados');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TBL_Articulos');
    }
}
