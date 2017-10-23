<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTBLDocumentacionTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::connection('unvinteraction')->create('TBL_Documentacion', function (Blueprint $table) {
             
            $table->increments('PK_Documentacion');
            $table->string('Entidad',120); 
            $table->string('Ubicacion',120); 
            $table->integer('FK_TBL_Convenios')->unsigned();
            $table->foreign('FK_TBL_Convenios')->references('PK_Convenios')->on('TBL_Convenios');
            
        
            
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
