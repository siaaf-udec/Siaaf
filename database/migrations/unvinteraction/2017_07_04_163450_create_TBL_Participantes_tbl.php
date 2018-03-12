<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTBLParticipantesTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::connection('unvinteraction')->create('TBL_Participantes', function (Blueprint $table) {
            $table->increments('PK_PTPT_Participantes');
            $table->integer('FK_TBL_Convenio_Id')->unsigned();
            $table->foreign('FK_TBL_Convenio_Id')->references('PK_CVNO_Convenio')->on('TBL_Convenio');
            $table->integer('FK_TBL_Usuarios_Id')->unsigned();
            $table->foreign('FK_TBL_Usuarios_Id')->references('PK_USER_Usuario')->on('TBL_Usuario');

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
