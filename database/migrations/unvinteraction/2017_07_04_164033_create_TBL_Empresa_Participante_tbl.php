<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTBLEmpresaParticipanteTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('unvinteraction')->create('TBL_Empresa_Participante', function (Blueprint $table) {
            $table->increments('PK_EMPT_Empresa_Participante');
            $table->integer('FK_TBL_Convenio_Id')->unsigned();
            $table->foreign('FK_TBL_Convenio_Id')->references('PK_CVNO_Convenio')->on('TBL_Convenio');
            $table->bigInteger('FK_TBL_Empresa_Id')->unsigned();
            $table->foreign('FK_TBL_Empresa_Id')->references('PK_EMPS_Empresa')->on('TBL_Empresa');
            $table->softDeletes();
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
        Schema::dropIfExists('TBL_Empresa_Participante');
    }
}
