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
            $table->bigIncrements('PK_EMPS_Empresa');
            $table->text('EMPS_Nombre_Empresa');
            $table->text('EMPS_Razon_Social');            
            $table->text('EMPS_Telefono');
            $table->text('EMPS_Direccion');
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
        //
        Schema::dropIfExists('TBL_Empresa');
    }
}
