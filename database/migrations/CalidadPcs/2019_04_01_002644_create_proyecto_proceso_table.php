<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProyectoProcesoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('calidadpcs')->create('TBL_Calidadpcs_proyecto_proceso', function (Blueprint $table) {
            $table->increments('PK_CPP_Id_Proy_Pro');
            $table->text('CPP_Info_Proceso')->nullable();
            $table->integer('FK_CPP_Id_Proyecto')->unsigned();
            $table->foreign('FK_CPP_Id_Proyecto')->references('PK_CP_Id_Proyecto')->on('TBL_Calidadpcs_proyectos')->onDelete("cascade");
            $table->integer('FK_CPP_Id_Proceso')->unsigned();
            $table->foreign('FK_CPP_Id_Proceso')->references('PK_CP_Id_Proceso')->on('TBL_Calidadpcs_procesos')->onDelete("cascade");
            
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
        Schema::dropIfExists('TBL_Calidadpcs_proyecto_proceso');
    }
}
