<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMctr008Gesap extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('gesap')->create('TBL_Mctr008', function (Blueprint $table) {
            $table->increments('PK_MCT_IdMctr008');
            $table->String('MCT_Titulo', 500);
            $table->String('MCT_Impacto', 500);
            $table->String('MCT_Trayectoria', 500);
            $table->String('MCT_ResEjecutivo', 500);
            $table->String('MCT_Planteamiento_Problema', 500);
            $table->String('MCT_Objetivo_General', 500);
            $table->String('MCT_Objetivos_Especificos', 500);
            $table->String('MCT_Metodologia', 500);
            $table->String('MCT_Estado_del_Arte', 500);
            $table->String('MCT_Bibliografia', 500);
            $table->String('MCT_Cronograma', 500);
            $table->String('MCT_Detalle_Persona_1', 500);
            $table->String('MCT_Detalle_Persona_2', 500);
            $table->String('MCT_Detalle_Persona_3', 500);
            $table->String('MCT_Financiacion_Fuentes', 500);
            $table->String('MCT_Resumen_Rubros', 500);
            $table->String('MCT_Resultados', 500);

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
        Schema::dropIfExists('TBL_GESAP_Mctr008');
    }
}
