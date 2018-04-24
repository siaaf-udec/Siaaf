<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoSancionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('audiovisuals')->create('TBL_Tipo_Sanciones', function (Blueprint $table) {
            $table->increments('id');
            $table->text('TIPO_Nombre');
            $table->text('TIPO_Descripcion');
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
        Schema::dropIfExists('TBL_Tipo_Sanciones');
    }
}
