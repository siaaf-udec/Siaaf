<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTBLUsuariosTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('unvinteraction')->create('TBL_Usuarios', function (Blueprint $table) {
            
            $table->increments('PK_Usuario');
                  
            $table->integer('FK_TBL_Carrera')->unsigned();
            $table->foreign('FK_TBL_Carrera')->references('PK_Carrera')->on('TBL_Carrera');
            
           
            $table->integer('FK_TBL_Estado_Usuario')->unsigned();
            $table->foreign('FK_TBL_Estado_Usuario')->references('PK_Estado_Usuario')->on('TBL_Estado_Usuario');
           
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
