<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTBLPreguntaTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('unvinteraction')->create('TBL_Pregunta', function (Blueprint $table) {
            $table->increments('PK_PRGT_Pregunta');
            $table->text('PRGT_Enunciado');
            $table->integer('FK_TBL_Tipo_Pregunta_Id')->unsigned();
            $table->foreign('FK_TBL_Tipo_Pregunta_Id')->references('PK_TPPG_Tipo_Pregunta')->on('TBL_Tipo_Pregunta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('TBL_Pregunta');
    }
}
