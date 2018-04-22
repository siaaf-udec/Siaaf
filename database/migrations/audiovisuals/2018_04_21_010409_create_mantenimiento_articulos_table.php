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
            $table->String('TMT_TipoArticulo');
            $table->String('TMT_Codigo');
            $table->dateTime('TMT_Fecha_Registro');
            $table->integer('TMT_Horas_Uso')->unsigned()->nullable();
            $table->integer('TMT_Cantidad_Mantenimiento')->unsigned()->nullable();


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
