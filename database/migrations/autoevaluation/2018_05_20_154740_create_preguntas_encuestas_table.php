<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreguntasEncuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection("autoevaluation")->create('TBL_Preguntas_Encuestas', function (Blueprint $table) {
            $table->increments('PK_PEN_Id');
            $table->integer("FK_PEN_Pregunta")->unsigned();
            $table->integer("FK_PEN_Encuesta")->unsigned();

            $table->foreign("FK_PEN_Pregunta")->references("PK_PPR_Id")->on("TBL_Preguntas_Procesos")->onDelete("cascade");
            $table->foreign("FK_PEN_Encuesta")->references("PK_ECT_Id")->on("TBL_Encuestas")->onDelete("cascade");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TBL_Preguntas_Encuestas');
    }
}
