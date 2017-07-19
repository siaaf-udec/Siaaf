<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->integer('PK_FNS_Cedula')->unsigned()->unique()->primary();
            $table->String('FNS_Clave',40);
            $table->String('FK_FNS_Rol',90);
            $table->String('FNS_Nombres',90);
            $table->String('FNS_Apellidos',90);
            $table->String('FNS_Direccion',45);
            $table->String('FNS_Correo',60);
            $table->String('FNS_Telefono',90);
            $table->String('FK_FNS_Estado',35)->nullable();
            
            
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
