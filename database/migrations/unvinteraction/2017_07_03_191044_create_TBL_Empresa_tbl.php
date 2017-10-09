<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTBLEmpresaTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('unvinteraction')->create('TBL_Empresa', function (Blueprint $table) {
            
            $table->increments('PK_Empresa');
            $table->string('Nombre_Empresa',90);
            $table->string('Razon_Social',90);            
            $table->string('Telefono',30);
            $table->string('Direccion',90);
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
