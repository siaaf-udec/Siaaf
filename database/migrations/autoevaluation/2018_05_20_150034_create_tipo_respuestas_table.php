<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoRespuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection("autoevaluation")->create('TBL_Tipo_Respuestas', function (Blueprint $table) {
            $table->increments('PK_TRP_Id');
            $table->integer("TRP_TotalPonderacion");
            $table->integer("TRP_CantidadRespuestas");
            $table->string("TRP_Descripcion", 350);
            $table->integer("FK_TRP_Estado")->unsigned();
            $table->timestamps();

            $table->foreign("FK_TRP_Estado")->references("PK_ESD_Id")->on("TBL_Estados")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TBL_Tipo_Respuestas');
    }
}
