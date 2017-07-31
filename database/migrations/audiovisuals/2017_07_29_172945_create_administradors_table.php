<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdministradorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('audiovisuals')->create('TBL_Administradores', function (Blueprint $table) {
            $table->integer('PK_ADMIN_Cedula')->unsigned()->unique()->primary();
            $table->String('ADMIN_Clave', 40);
            $table->String('FK_ADMIN_Rol', 90);
            $table->String('ADMIN_Nombres', 90);
            $table->String('ADMIN_Apellidos', 90);
            $table->String('ADMIN_Direccion', 45);
            $table->String('ADMIN_Correo', 60);
            $table->String('ADMIN_Telefono', 90);
            $table->String('FK_ADMIN_Estado', 35)->nullable();

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TBL_Administradores');
    }
}
