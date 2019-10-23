<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcesoAsegurarCalidad extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('calidadpcs')->create('TBL_Calidadpcs_proceso_aseguramiento', function (Blueprint $table) {
            $table->increments('PK_CPA_Id_Aseguramiento');
            $table->text('CPA_Aseguramiento');
            $table->string('CPA_Desempeño')->nullable();
            $table->text('CPA_Recomendaciones')->nullable();
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
        Schema::dropIfExists('TBL_Calidadpcs_proceso_aseguramiento');
    }
}
