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
            $table->text('NTFC_Titulo');       
            $table->text('NTFC_Mensaje');
            $table->text('NTFC_Bandera',11);
            $table->date('NTFC_Fecha_Vista'); 
            $table->integer('FK_TBL_Usuarios_Id')->unsigned();
            $table->foreign('FK_TBL_Usuarios_Id')->references('PK_USER_Usuario')->on('TBL_Usuario');
            $table->timestamps();
        });
    }
     public function down()
    {
        
         Schema::dropIfExists('TBL_Notificacion');
    }
   
}
