<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTBLPreguntasTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::connection('unvinteraction')->create('TBL_Preguntas', function (Blueprint $table) {
             
            $table->increments('PK_Preguntas');
            $table->string('Enunciado',120); 
                
            
            $table->integer('FK_TBL_Tipo_Pregunta')->unsigned();
            $table->foreign('FK_TBL_Tipo_Pregunta')->references('PK_Tipo_Pregunta')->on('TBL_Tipo_Pregunta');
            
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
