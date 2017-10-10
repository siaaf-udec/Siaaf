<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTBLEvaluacionTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
<<<<<<< Updated upstream
       
         Schema::connection('unvinteraction')->create('TBL_Evaluacion', function (Blueprint $table) {
             
            $table->increments('PK_Evaluacion');
            $table->bigInteger('Evaluador');
            $table->bigInteger('Evaluado');
=======
        //
         Schema::connection('unvinteraction')->create('TBL_Evaluacion', function (Blueprint $table) {
             
            $table->increments('PK_Evaluacion');
            $table->integer('Evaluador');
             $table->integer('Evaluado');
>>>>>>> Stashed changes
                        
            $table->integer('FK_TBL_Convenios')->unsigned();
            $table->foreign('FK_TBL_Convenios')->references('PK_Convenios')->on('TBL_Convenios');
             
<<<<<<< Updated upstream
            $table->integer('Tipo_Evaluacion');
            $table->float('Nota_Final');
=======
            $table->integer('FK_TBL_Preguntas')->unsigned();
            $table->foreign('FK_TBL_Preguntas')->references('PK_Preguntas')->on('TBL_Preguntas');
            
>>>>>>> Stashed changes
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
