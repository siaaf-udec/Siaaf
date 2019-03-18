<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRubrosEquipos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('gesap')->create('TBL_RBR_Equipos', function (Blueprint $table) {
            $table->increments('PK_RBR_Equipo');
            $table->String('RBR_EQP_Descripcion');
            $table->String('RBR_EQP_Lab');
            $table->String('RBR_EQP_Actividades');
            $table->String('RBR_EQP_Justificacion');
            $table->String('RBR_EQP_Cantidad');
            $table->String('RBR_EQP_Val');
            $table->String('RBR_EQP_Solicitado');
            $table->String('RBR_EQP_Contra_Udec');
            $table->String('RBR_EQP_Contra_Otro');
            $table->String('RBR_EQP_Total');
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
        Schema::dropIfExists('TBL_RBR_Equipos');
    }
}
