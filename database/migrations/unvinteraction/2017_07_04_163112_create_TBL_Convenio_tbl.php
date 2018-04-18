<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTBLConvenioTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('unvinteraction')->create('TBL_Convenio', function (Blueprint $table) {
            $table->increments('PK_CVNO_Convenio');
            $table->text('CVNO_Nombre'); 
            $table->date('CVNO_Fecha_Inicio'); 
            $table->date('CVNO_Fecha_Fin');
            $table->integer('FK_TBL_Estado_Id')->unsigned();
            $table->foreign('FK_TBL_Estado_Id')->references('PK_ETAD_Estado')->on('TBL_Estado');
            $table->integer('FK_TBL_Sede_Id')->unsigned();
            $table->foreign('FK_TBL_Sede_Id')->references('PK_SEDE_Sede')->on('TBL_Sede');
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
        Schema::dropIfExists('TBL_Convenio');
    }
}
