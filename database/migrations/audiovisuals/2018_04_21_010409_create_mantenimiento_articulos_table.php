<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMantenimientoArticulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('audiovisuals')->create('TBL_Mantenimiento_Articulos', function (Blueprint $table) {
            $table->increments('TMT_Id');
            $table->integer('TMT_FK_Id_Articulo');
            $table->integer('TMT_Cantidad_Mantenimiento');
            $table->String('TMT_Observacion');

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
        Schema::dropIfExists('TBL_Mantenimiento_Articulos');
    }
}
