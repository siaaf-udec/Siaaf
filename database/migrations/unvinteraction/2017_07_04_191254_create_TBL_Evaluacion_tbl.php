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
            $table->increments('PK_VLCN_Evaluacion');
            $table->bigInteger('VLCN_Evaluador');
            $table->bigInteger('VLCN_Evaluado');
            $table->date('VLCN_Fecha'); 
            $table->integer('FK_TBL_Convenio_Id')->unsigned();
            $table->foreign('FK_TBL_Convenio_Id')->references('PK_CVNO_Convenio')->on('TBL_Convenio');
            $table->float('VLCN_Nota_Final');
            $table->integer('VLCN_Tipo_Evaluacion')->unsigned();

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
