<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('humtalent')->create('TBL_Permiso', function (Blueprint $table)  {
            $table->increments('PK_PERM_IdPermiso')->unique();
            $table->date('PERM_Fecha');
            $table->String('PERM_Descripcion',300);
            $table->integer('FK_TBL_Persona_Cedula')->unsigned();
            $table->foreign('FK_TBL_Persona_Cedula')->references('PK_PRSN_Cedula')->on('TBL_Personas');
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
        Schema::dropIfExists('TBL_Permiso');
    }
}
