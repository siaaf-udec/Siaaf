<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('acadspace')->create('tbl_articulos', function (Blueprint $table) {
            $table->increments('pk_id_articulo')->unsigned()->unique();
            $table->string('codigo_articulo',50);
            $table->string('descripcion_articulo',450)->nullable();
            $table->datetime('fecha_registro')->useCurrent();
            $table->integer('fk_id_categoria')->unsigned();
            $table->integer('fk_id_hojavida')->nullable()->unsigned();
            $table->integer('fk_id_procedencia')->unsigned();
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
        Schema::dropIfExists('tbl_articulos');
    }
}
