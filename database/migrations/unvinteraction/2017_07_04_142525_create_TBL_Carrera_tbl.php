<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTBLCarreraTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::connection('unvinteraction')->create('TBL_Carrera', function (Blueprint $table) {
             
            $table->increments('PK_Carrera');
            $table->string('Carrera',120); 
            $table->integer('FK_TBL_Facultad')->unsigned();
            $table->foreign('FK_TBL_Facultad')->references('PK_Facultad')->on('TBL_Facultad');
           
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
