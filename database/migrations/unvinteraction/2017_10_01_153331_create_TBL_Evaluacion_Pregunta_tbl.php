<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTBLEvaluacionPreguntaTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('unvinteraction')->create('TBL_Evaluacion_Pregunta', function (Blueprint $table) {
            $table->increments('PK_VCPT_Evaluacion_Pregunta');
            $table->integer('VCPT_Puntuacion');                        
            $table->integer('FK_TBL_Evaluacion_Id')->unsigned();
            $table->foreign('FK_TBL_Evaluacion_Id')->references('PK_VLCN_Evaluacion')->on('TBL_Evaluacion');
            $table->integer('FK_TBL_Pregunta_Id')->unsigned();
            $table->foreign('FK_TBL_Pregunta_Id')->references('PK_PRGT_Pregunta')->on('TBL_Pregunta');
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
        //
        Schema::dropIfExists('TBL_Evaluacion_Pregunta');
    }
}
