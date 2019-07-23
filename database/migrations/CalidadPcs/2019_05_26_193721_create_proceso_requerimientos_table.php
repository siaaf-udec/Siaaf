<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcesoRequerimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('calidadpcs')->create('TBL_Calidadpcs_proceso_requerimientos', function (Blueprint $table) {
            $table->increments('PK_CPR_Id_Requerimientos');
            $table->String('CPR_Nombre_Requerimiento')->nullable();
            $table->integer('FK_CPR_Id_Proyecto')->unsigned();
            $table->foreign('FK_CPR_Id_Proyecto')->references('PK_CP_Id_Proyecto')->on('TBL_Calidadpcs_proyectos');
            $table->integer('FK_CPR_Id_Proceso')->unsigned();
            $table->foreign('FK_CPR_Id_Proceso')->references('PK_CP_Id_Proceso')->on('TBL_Calidadpcs_procesos');
            
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
        Schema::dropIfExists('TBL_Calidadpcs_proceso_requerimientos');
    }
}
