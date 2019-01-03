<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserGesap extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
  
    public function up()
    {
        Schema::connection('gesap')->create('TBL_Usuario', function (Blueprint $table) {
            $table->increments('PK_User_Codigo');
            $table->bigInteger('User_Cedula');
            $table->String('User_Nombre1', 50);
            $table->String('User_Nombre2', 50)->nullable();
            $table->String('User_Apellido1', 50);
            $table->String('User_Apellido2', 50)->nullable();
            $table->String('User_Correo', 90);
            $table->String('User_Direccion', 70)->nullable();
            $table->integer('Fk_User_IdEstado')->unsigned();
            $table->foreign('FK_User_IdEstado')
                ->references('Pk_IdEstado')
                ->on('TBL_Estados')
                ->onDelete('cascade');
            $table->integer('FK_User_IdRol')->unsigned();
            $table->foreign('FK_User_IdRol')
                ->references('PK_Id_Rol_Usuario')
                ->on('TBL_Rol')
                ->onDelete('cascade');

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
        Schema::dropIfExists('TBL_Usuario');
    }
}
