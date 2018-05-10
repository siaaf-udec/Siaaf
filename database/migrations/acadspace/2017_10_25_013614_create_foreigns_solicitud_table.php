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
        
        /** NUEVAS RELACIONES VERSION 2.0 */

        Schema::connection('acadspace')->table('TBL_Incidentes', function (Blueprint $table) {
            $table->foreign('FK_INC_Id_Articulo')->references('PK_ART_Id_Articulo')->on('TBL_Articulos')
                ->onDelete('cascade');
        });
       
        Schema::connection('acadspace')->table('TBL_Imagenes', function (Blueprint $table) {
            $table->foreign('FK_IMA_Id_Articulo')->references('PK_ART_Id_Articulo')->on('TBL_Articulos')
                ->onDelete('cascade');
        });

        Schema::connection('acadspace')->table('TBL_Articulos', function (Blueprint $table) {
            $table->foreign('FK_ART_Id_Categoria')->references('PK_CAT_Id_Categoria')->on('TBL_Categorias')
                ->onDelete('cascade');
        });

        Schema::connection('acadspace')->table('TBL_Articulos', function (Blueprint $table) {
            $table->foreign('FK_ART_Id_Hojavida')->references('PK_HOJ_Id_Hojavida')->on('TBL_Hojavida')
                ->onDelete('cascade');
        });

        Schema::connection('acadspace')->table('TBL_Articulos', function (Blueprint $table) {
            $table->foreign('FK_ART_Id_Procedencia')->references('PK_PRO_Id_Procedencia')->on('TBL_Procedencias');
        });

        Schema::connection('acadspace')->table('TBL_Hojavida', function (Blueprint $table) {
            $table->foreign('FK_HOJ_Id_Marca')->references('PK_MAR_Id_Marca')->on('TBL_Marca')
                ->onDelete('cascade');
        });

        Schema::connection('acadspace')->table('TBL_Registro_Mantenimientos', function (Blueprint $table) {
            $table->foreign('FK_MANT_Id_Hojavida')->references('PK_HOJ_Id_Hojavida')->on('TBL_Hojavida')
                ->onDelete('cascade');
        });

        Schema::connection('acadspace')->table('TBL_Registro_Mantenimientos', function (Blueprint $table) {
            $table->foreign('FK_MANT_Id_Tipo')->references('PK_MAN_Id_Tipo')->on('TBL_Tipo_Mantenimientos')
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
