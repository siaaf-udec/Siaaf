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
        Schema::connection('acadspace')->create('TBL_Imagenes', function (Blueprint $table) {
            $table->increments('PK_IMA_Id_Imagen')->unsigned()->unique();
            $table->string('IMA_Ruta',250);
            $table->string('IMA_Nombre',250);
            $table->integer('FK_IMA_Id_Articulo')->unsigned();
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
        Schema::dropIfExists('TBL_Imagenes');
    }
}