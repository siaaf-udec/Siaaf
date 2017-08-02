<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModUserCKsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('carpark')->create('TBL_User_Parks', function (Blueprint $table) {
          $table->integer('PK_CK_Cedula')->unsigned()->unique()->primary();
          $table->String('CK_Nombres',90);
          $table->String('CK_Apellidos',90);
          $table->String('CK_Telefono',45);
          $table->String('CK_Correo',60);
          $table->String('CK_Direccion',90);
          $table->String('CK_Ciudad',35);
          $table->integer('CK_Codigo')->unsigned()->unique();
          $table->integer('CK_IdPrograma')->unsigned();


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
        Schema::dropIfExists('TBL_User_Parks');
    }
}
