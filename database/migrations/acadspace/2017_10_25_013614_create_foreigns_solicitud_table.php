<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignsSolicitudTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('acadspace')->table('TBL_Solicitud', function (Blueprint $table) {
            $table->foreign('FK_SOL_Id_Sala')->references('PK_SAL_Id_Sala')->on('TBL_Aulas')
                ->onDelete('cascade');
        });

        Schema::connection('acadspace')->table('TBL_Aulas', function (Blueprint $table) {
            $table->foreign('FK_SAL_Id_Espacio')->references('PK_ESP_Id_Espacio')->on('TBL_Espacios')
                ->onDelete('cascade');
        });

        Schema::connection('acadspace')->table('TBL_Calendario', function (Blueprint $table) {
            $table->foreign('FK_CAL_Id_Sala')->references('PK_SAL_Id_Sala')->on('TBL_Aulas')
                ->onDelete('cascade');
        });

        Schema::connection('acadspace')->table('TBL_Solicitud', function (Blueprint $table) {
            $table->foreign('FK_SOL_Id_Software')->references('PK_SOF_Id')->on('TBL_Software');
        });

        Schema::connection('acadspace')->table('TBL_Incidentes', function (Blueprint $table) {
            $table->foreign('FK_INC_Id_Espacio')->references('PK_ESP_Id_Espacio')->on('TBL_Espacios')
                ->onDelete('cascade');
        });

        Schema::connection('acadspace')->table('TBL_Asistencias', function (Blueprint $table) {
            $table->foreign('FK_ASIS_Id_Aula')->references('PK_SAL_Id_Sala')->on('TBL_Aulas')
                ->onDelete('cascade');
        });

        Schema::connection('acadspace')->table('TBL_Asistencias', function (Blueprint $table) {
            $table->foreign('FK_ASIS_Id_Espacio')->references('PK_ESP_Id_Espacio')->on('TBL_Espacios')
                ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
