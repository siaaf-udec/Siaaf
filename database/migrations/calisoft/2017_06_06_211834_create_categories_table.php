<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('calisoft')->create('TBL_Categorias', function (Blueprint $table) {
            $table->increments('PK_id');
            $table->string('nombre')->unique();
            $table->integer('plataforma');
            $table->integer('modelado');
            $table->integer('clases');
            $table->integer('uso');
            $table->integer('despliegue');
            $table->integer('sequencia');
            $table->integer('actividades');
            $table->integer('entidad_relacion');
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
        Schema::dropIfExists('TBL_Categorias');
    }
}
