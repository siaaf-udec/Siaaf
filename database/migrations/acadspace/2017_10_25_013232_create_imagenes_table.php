<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('acadspace')->create('tbl_imagenes', function (Blueprint $table) {
            $table->increments('pk_id_imagen')->unsigned()->unique();
            $table->string('ruta_imagen',250);
            $table->string('nombre_imagen',250);
            $table->integer('fk_id_articulo')->unsigned();
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
        Schema::dropIfExists('tbl_imagenes');
    }
}