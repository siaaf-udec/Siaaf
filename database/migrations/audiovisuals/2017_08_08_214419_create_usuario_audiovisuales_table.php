<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuarioAudiovisualesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('audiovisuals')->create('TBL_Usuario_Audiovisuales', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('USER_FK_User')->unsigned()->unique()->nullable();
            $table->integer('USER_FK_Programa')->unsigned()->unique()->nullable();

            $table->foreign('USER_FK_Programa')->references('id')->on('TBL_Programas');


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
        Schema::dropIfExists('TBL_Usuario_Audiovisuales');
    }
}
