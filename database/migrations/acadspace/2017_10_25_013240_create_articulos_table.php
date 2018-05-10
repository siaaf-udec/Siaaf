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
        Schema::connection('acadspace')->create('TBL_Articulos', function (Blueprint $table) {
            $table->increments('PK_ART_Id_Articulo')->unsigned()->unique();
            $table->string('ART_Codigo',50);
            $table->string('ART_Descripcion',450)->nullable();
            $table->datetime('ART_Fecha_Registro')->useCurrent();
            $table->integer('FK_ART_Id_Categoria')->unsigned();
            $table->integer('FK_ART_Id_Hojavida')->nullable()->unsigned();
            $table->integer('FK_ART_Id_Procedencia')->unsigned();
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
        Schema::dropIfExists('TBL_Articulos');
    }
}
