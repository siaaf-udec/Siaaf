<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcesoCostosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('calidadpcs')->create('TBL_Calidadpcs_proceso_costos', function (Blueprint $table) {
            $table->increments('PK_CPC_Id_Costo');
            $table->double('CPC_Valor',12,2);
            $table->integer('CPC_Estado')->default(0);
            $table->integer('FK_CPC_Id_Formula')->unsigned();
            $table->foreign('FK_CPC_Id_Formula')->references('PK_CPCI_Id_Costos')->on('TBL_Calidadpcs_proceso_costos_informacion')->onDelete("cascade");
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
        Schema::dropIfExists('TBL_Calidadpcs_proceso_costos');
    }
}
