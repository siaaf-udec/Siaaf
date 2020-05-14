<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcesoGestionRiesgos extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('calidadpcs')->create('TBL_Calidadpcs_proceso_riesgos', function (Blueprint $table) {
            $table->increments('PK_CPGR_Id_Riesgo');
            $table->string('CPGR_Riesgo');
            $table->string('CPGR_Caracteristicas');
            $table->string('CPGR_Importancia');
            $table->string('CPGR_Accion');
            $table->integer('CPGR_Estado')->default(0);
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
        Schema::dropIfExists('TBL_Calidadpcs_proceso_riesgos');
    }
}
