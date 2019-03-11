<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCronograma extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('gesap')->create('TBL_MCT_Cronograma', function (Blueprint $table) {
            $table->increments('PK_Id_Cronograma');
            $table->String('MCT_CRN_Actividad');
            $table->String('MCT_CRN_Semana_Inicio');
            $table->String('MCT_CRN_Semana_Fin');
            $table->String('MCT_CRN_Responsable');
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
        Schema::dropIfExists('TBL_MCT_Cronograma');
    }
}
