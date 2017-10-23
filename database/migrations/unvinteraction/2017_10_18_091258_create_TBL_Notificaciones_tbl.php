<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTBLNotificacionesTbl extends Migration
{
    public function up()
    {
        Schema::connection('unvinteraction')->create('TBL_Notificaciones', function (Blueprint $table) {
            
            $table->increments('PK_Notificacion');
            $table->string('Titulo',120);       
            $table->string('Mensaje',300);
            $table->string('Bandera',11);
            $table->integer('FK_TBL_Usuarios')->unsigned();
            
            
           
           
        });
    }
     public function down()
    {
        //
    }
   
}
