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

         Schema::connection('unvinteraction')->create('TBL_Evaluacion', function (Blueprint $table) {
             
            $table->increments('PK_Evaluacion');
            $table->bigInteger('Evaluador');
            $table->bigInteger('Evaluado');
            $table->date('Fecha'); 
            $table->integer('FK_TBL_Convenios')->unsigned();
            $table->foreign('FK_TBL_Convenios')->references('PK_Convenios')->on('TBL_Convenios');
            $table->float('Nota_Final');
            $table->integer('Tipo_Evaluacion')->unsigned();

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
