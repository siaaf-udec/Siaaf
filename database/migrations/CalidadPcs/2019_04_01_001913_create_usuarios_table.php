<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('calidadpcs')->create('TBL_Calidadpcs_Usuarios', function (Blueprint $table) {
            $table->bigInteger('PK_CU_Id_Usuario')->unsigned()->unique()->primary();
            $table->bigInteger('CU_Cedula');
            $table->String('CU_Nombre', 50);
            $table->String('CU_Apellido', 50);
            $table->String('CU_Telefono', 45)->nullable();
            $table->String('CU_Correo', 90);

            //$table->integer('FK_CU_Id_Estado')->unsigned();
            //$table->foreign('FK_CU_Id_Estado')->references('PK_CE_Id_Estado')->on('TBL_Calidadpcs_Estados');
            //$table->integer('FK_CU_Id_Dependencia')->unsigned();
            //$table->foreign('FK_CU_Id_Dependencia')->references('PK_CD_Id_Dependencia')->on('TBL_Calidadpcs_Dependencias');

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
        Schema::dropIfExists('TBL_Calidadpcs_Usuarios');
    }
}
