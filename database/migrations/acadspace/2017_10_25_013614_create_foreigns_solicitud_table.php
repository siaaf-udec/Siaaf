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

        Schema::connection('acadspace')->table('tbl_incidentes', function (Blueprint $table) {
            $table->foreign('fk_id_articulo')->references('pk_id_articulo')->on('tbl_articulos')
                ->onDelete('cascade');
        });
       
        Schema::connection('acadspace')->table('tbl_imagenes', function (Blueprint $table) {
            $table->foreign('fk_id_articulo')->references('pk_id_articulo')->on('tbl_articulos')
                ->onDelete('cascade');
        });

        Schema::connection('acadspace')->table('tbl_articulos', function (Blueprint $table) {
            $table->foreign('fk_id_categoria')->references('pk_id_categoria')->on('tbl_categorias')
                ->onDelete('cascade');
        });

        Schema::connection('acadspace')->table('tbl_articulos', function (Blueprint $table) {
            $table->foreign('fk_id_hojavida')->references('pk_id_hojavida')->on('tbl_hojavida')
                ->onDelete('cascade');
        });

        Schema::connection('acadspace')->table('tbl_articulos', function (Blueprint $table) {
            $table->foreign('fk_id_procedencia')->references('pk_id_procedencia')->on('tbl_procedencias');
        });

        Schema::connection('acadspace')->table('tbl_hojavida', function (Blueprint $table) {
            $table->foreign('fk_id_marca_equipo')->references('pk_id_marca_equipo')->on('tbl_marca_equipos')
                ->onDelete('cascade');
        });

        Schema::connection('acadspace')->table('tbl_registro_mantenimientos', function (Blueprint $table) {
            $table->foreign('fk_id_hojavida')->references('pk_id_hojavida')->on('tbl_hojavida')
                ->onDelete('cascade');
        });

        Schema::connection('acadspace')->table('tbl_registro_mantenimientos', function (Blueprint $table) {
            $table->foreign('fk_id_tipo_mantenimiento')->references('pk_id_tipo_mantenimiento')->on('tbl_tipo_mantenimientos')
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
