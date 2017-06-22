<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('humtalent')->create('TBL_Personas', function (Blueprint $table) {
            $table->integer('PK_PRSN_Cedula')->unsigned()->unique()->primary();
            $table->integer('PRSN_Rol')->unsigned();
            $table->String('PRSN_Nombres',90);
            $table->String('PRSN_Apellidos',90);
            $table->String('PRSN_Telefono',45);
            $table->String('PRSN_Correo',60);
            $table->String('PRSN_Direccion',90);
            $table->String('PRSN_Ciudad',35);
            $table->String('PRSN_Eps',35)->nullable();
            $table->String('PRSN_Fpensiones',35)->nullable();
            $table->String('PRSN_Area',45);
            $table->String('PRSN_Caja_Compensacion',45)->nullable();
            $table->String('PRSN_Estado_Persona',30);


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
        Schema::dropIfExists('TBL_Personas');
    }
}
