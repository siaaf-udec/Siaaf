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
            $table->bigIncrements('PK_EMPS_Empresa',12);
            $table->string('EMPS_Nombre_Empresa',90);
            $table->string('EMPS_Razon_Social',90);            
            $table->string('EMPS_Telefono',30);
            $table->string('EMPS_Direccion',90);
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
