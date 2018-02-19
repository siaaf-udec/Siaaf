<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTBLNotificacionTbl extends Migration
{
    public function up()
    {
        Schema::connection('unvinteraction')->create('TBL_Notificacion', function (Blueprint $table) {
            $table->increments('PK_NTFC_Notificacion');
            $table->string('NTFC_Titulo',120);       
            $table->string('NTFC_Mensaje',3000);
            $table->string('NTFC_Bandera',11);
            $table->integer('FK_TBL_Usuarios_Id')->unsigned();
            $table->foreign('FK_TBL_Usuarios_Id')->references('PK_USER_Usuario')->on('TBL_Usuario');
        });
    }
     public function down()
    {
        //
    }
   
}
