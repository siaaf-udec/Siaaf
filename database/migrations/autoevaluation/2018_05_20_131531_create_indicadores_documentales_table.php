<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndicadoresDocumentalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection("autoevaluation")->create('TBL_Indicadores_Documentales', function (Blueprint $table) {
            $table->increments('PK_IDO_Id');
            $table->string("IDO_Nombre");
            $table->mediumText("IDO_Descripcion")->nullable();
            $table->integer("IDO_Identificador");
            $table->integer("FK_IDO_Caracteristica")->unsigned();
            $table->integer("FK_IDO_Estado")->unsigned();
            $table->timestamps();

            $table->foreign("FK_IDO_Caracteristica")->references("PK_CRT_Id")->on("TBL_Caracteristicas")->onDelete("cascade");
            $table->foreign("FK_IDO_Estado")->references("PK_ESD_Id")->on("TBL_Estados")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TBL_Indicadores_Documentales');
    }
}
