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
            $table->String('TMT_Tipo_Articulo')->nullable();
            $table->integer('TMT_FK_Id_Articulo')->unsigned()->nullable();
            $table->String('TMT_Observacion_Realiza')->nullable();
            $table->String('TMT_Observacion_Finaliza')->nullable();
            $table->integer('FK_TMT_Estado_id')->unsigned()->nullable();
            $table->integer('FK_TMT_Tipo_Solicitud')->unsigned()->nullable();

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
