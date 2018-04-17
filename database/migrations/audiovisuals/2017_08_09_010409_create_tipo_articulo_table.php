<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoArticuloTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('audiovisuals')->create('TBL_Tipo_articulos', function (Blueprint $table) {
            $table->increments('id');
            $table->String('TPART_Nombre');
			$table->integer('TPART_Tiempo')->unsigned()->nullable();
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
        Schema::dropIfExists('TBL_Tipo_articulos');
    }
}
