<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTBLConveniosTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::connection('unvinteraction')->create('TBL_Convenios', function (Blueprint $table) {
            
            $table->increments('PK_Convenios');
            $table->string('Nombre',120); 
            $table->date('Fecha_Inicio'); 
            $table->date('Fecha_Fin'); 
            
            
            
            
                        
            $table->integer('FK_TBL_Estado')->unsigned();
            $table->foreign('FK_TBL_Estado')->references('PK_Estado')->on('TBL_Estado');
            
            $table->integer('FK_TBL_Sede')->unsigned();
            $table->foreign('FK_TBL_Sede')->references('PK_Sede')->on('TBL_Sede');
           
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
