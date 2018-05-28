<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTBLUsuarioTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('unvinteraction')->create('TBL_Usuario', function (Blueprint $table) {
            $table->increments('PK_USER_Usuario');
            $table->bigInteger('USER_FK_Users')->unsigned();
            $table->timestamps();
            $table->softDeletes();
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
        Schema::dropIfExists('TBL_Usuario');
    }
}
