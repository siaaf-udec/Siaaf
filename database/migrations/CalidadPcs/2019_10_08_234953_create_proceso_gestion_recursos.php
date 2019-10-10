<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcesoGestionRecursos extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('calidadpcs')->create('TBL_Calidadpcs_proceso_recursos', function (Blueprint $table) {
            $table->increments('PK_CPGR_Id_Gestion');
            $table->string('CPGR_Funcion');
            $table->integer('FK_CPGR_Id_Equipo')->unsigned();
            $table->foreign('FK_CPGR_Id_Equipo')->references('PK_CE_Id_Equipo_Scrum')->on('TBL_Calidadpcs_equipo_scrum')->onDelete("cascade");
            $table->integer('FK_CPC_Id_Proyecto')->unsigned();
            $table->foreign('FK_CPC_Id_Proyecto')->references('PK_CP_Id_Proyecto')->on('TBL_Calidadpcs_proyectos')->onDelete("cascade");
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
        Schema::dropIfExists('TBL_Calidadpcs_proceso_recursos');
    }
}


