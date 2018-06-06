<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreguntasProcesosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection("autoevaluation")->create('TBL_Preguntas_Procesos', function (Blueprint $table) {
            $table->increments('PK_PPR_Id');
            $table->integer("FK_PPR_Pregunta")->unsigned();
            $table->integer("FK_PPR_Proceso")->unsigned();
            $table->integer("FK_PPR_GruposInteres")->unsigned();

            $table->foreign("FK_PPR_Pregunta")->references("PK_PGT_Id")->on("TBL_Preguntas")->onDelete("cascade");
            $table->foreign("FK_PPR_Proceso")->references("PK_PCS_Id")->on("TBL_Procesos")->onDelete("cascade");
            $table->foreign("FK_PPR_GruposInteres")->references("PK_GIT_Id")->on("TBL_Grupos_Interes")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TBL_Preguntas_Procesos');
    }
}
