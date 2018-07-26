<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('carpark')->create('TBL_Carpark_Usuarios', function (Blueprint $table) {
            $table->bigInteger('PK_CU_Codigo')->unsigned()->unique()->primary();
            $table->bigInteger('CU_Cedula');
            $table->String('CU_Nombre1', 50);
            $table->String('CU_Nombre2', 50)->nullable();
            $table->String('CU_Apellido1', 50);
            $table->String('CU_Apellido2', 50)->nullable();
            $table->String('CU_Telefono', 45)->nullable();
            $table->String('CU_Correo', 90);
            $table->String('CU_Direccion', 70)->nullable();
            $table->String('CU_UrlFoto', 90);
            $table->integer('FK_CU_IdEstado')->unsigned();
            $table->foreign('FK_CU_IdEstado')->references('PK_CE_IdEstados')->on('TBL_Carpark_Estados');
            $table->integer('FK_CU_IdDependencia')->unsigned();
            $table->foreign('FK_CU_IdDependencia')->references('PK_CD_IdDependencia')->on('TBL_Carpark_Dependencias');

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
        Schema::dropIfExists('TBL_Carpark_Usuarios');
    }
}
