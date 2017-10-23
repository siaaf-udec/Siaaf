<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTBLEvaluacionPreguntasTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('unvinteraction')->create('TBL_Evaluacion_Preguntas', function (Blueprint $table) {
             
            $table->increments('PK_Evaluacion_Preguntas');
            $table->integer('Puntuacion');                        
            $table->integer('FK_TBL_Evaluacion')->unsigned();
            $table->foreign('FK_TBL_Evaluacion')->references('PK_Evaluacion')->on('TBL_Evaluacion');
            $table->integer('FK_TBL_Preguntas')->unsigned();
            $table->foreign('FK_TBL_Preguntas')->references('PK_Preguntas')->on('TBL_Preguntas');
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
    }
}
