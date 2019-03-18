<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRubrosTecnologicos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('gesap')->create('TBL_RBR_Tecnologico', function (Blueprint $table) {
            $table->increments('PK_RBR_Tecnologico');
            $table->String('RBR_TEC_Descripcion');
            $table->String('RBR_TEC_Justificacion');
            $table->String('RBR_TEC_Val');
            $table->String('RBR_TEC_Entidad');
            $table->String('RBR_TEC_Solicitado_Udec');
            $table->String('RBR_TEC_Contra_Udec');
            $table->String('RBR_TEC_Contra_Otro');
            $table->String('RBR_TEC_Total');
            $table->Integer('FK_NPRY_IdMctr008')->unsigned();
            $table->foreign('FK_NPRY_IdMctr008')
                  ->references('PK_NPRY_IdMctr008')
                  ->on('TBL_Anteproyecto')
                  ->onDelete('cascade');
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
        Schema::dropIfExists('TBL_RBR_Tecnologico');
    }
}
