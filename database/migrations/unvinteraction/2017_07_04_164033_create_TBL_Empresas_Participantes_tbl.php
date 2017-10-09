<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTBLEmpresasParticipantesTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::connection('unvinteraction')->create('TBL_Empresas_Participantes', function (Blueprint $table) {
            
            $table->increments('PK_Empresas_Participantes');           
            
            $table->integer('FK_TBL_Convenios')->unsigned();
            $table->foreign('FK_TBL_Convenios')->references('PK_Convenios')->on('TBL_Convenios');
            
            $table->integer('FK_TBL_Empresa')->unsigned();
            $table->foreign('FK_TBL_Empresa')->references('PK_Empresa')->on('TBL_Empresa');
            
           
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
