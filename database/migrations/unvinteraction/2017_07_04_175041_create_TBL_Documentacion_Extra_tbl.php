<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTBLDocumentacionExtraTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::connection('unvinteraction')->create('TBL_Documentacion_Extra', function (Blueprint $table) {
            
            $table->increments('PK_Documentacion_Extra');
            $table->string('Descripcion',120); 
            $table->string('Ubicacion');
            $table->string('Entidad',90);
            
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
