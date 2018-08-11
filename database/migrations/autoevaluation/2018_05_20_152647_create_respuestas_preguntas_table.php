<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespuestasPreguntasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection("autoevaluation")->create('TBL_Respuestas_Preguntas', function (Blueprint $table) {
            $table->increments('PK_RPG_Id');

            $table->string("RPG_Texto", 300);
            $table->integer("FK_RPG_Pregunta")->unsigned();
            $table->integer("FK_RPG_PonderacionRespuesta")->unsigned();
            $table->timestamps();

            $table->foreign("FK_RPG_Pregunta")->references("PK_PGT_Id")->on("TBL_Preguntas")->onDelete("cascade");
            $table->foreign("FK_RPG_PonderacionRespuesta")->references("PK_PRT_Id")->on("TBL_Ponderacion_Respuestas")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TBL_Respuestas_Preguntas');
    }
}
