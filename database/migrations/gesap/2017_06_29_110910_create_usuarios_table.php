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
        Schema::connection('gesap')->create('tbl_users', function (Blueprint $table) {
            $table->integer('PK_SRS_Cedula')->unsigned()->unique()->primary();
            $table->string('SRS_Nombre');
            $table->string('SRS_Apellido',50);
            $table->integer('SRS_Telefono');
            $table->string('SRS_Correo')->unique();
            $table->string('SRS_Passsword');
            $table->integer('FK_TBL_Rol_id')->unsigned();
            $table->foreign('FK_TBL_Rol_id')->references('PK_ROL_idRol')->on('TBL_Rol');
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
        Schema::dropIfExists('tbl_users');
    }
}
