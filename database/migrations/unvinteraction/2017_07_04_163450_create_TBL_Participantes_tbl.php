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
            
            $table->increments('PK_Participantes');           
            
            $table->integer('FK_TBL_Convenios')->unsigned();
            $table->foreign('FK_TBL_Convenios')->references('PK_Convenios')->on('TBL_Convenios');
            
            $table->integer('FK_TBL_Usuarios')->unsigned();

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
