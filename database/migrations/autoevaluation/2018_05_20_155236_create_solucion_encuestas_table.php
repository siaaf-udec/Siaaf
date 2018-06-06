<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolucionEncuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection("autoevaluation")->create('TBL_Solucion_Encuestas', function (Blueprint $table) {
            $table->increments('PK_SEC_Id');
            $table->integer("FK_SEC_Respuesta")->unsigned();
            $table->integer("FK_SEC_DatosEncuest")->unsigned();

            $table->foreign("FK_SEC_Respuesta")->references("PK_RPG_Id")->on("TBL_Respuestas_Preguntas")->onDelete("cascade");
            $table->foreign("FK_SEC_DatosEncuest")->references("PK_ECD_Id")->on("TBL_Encuestados")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TBL_Solucion_Encuestas');
    }
}
