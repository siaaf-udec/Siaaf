<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcesoGestionComunicacion extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('calidadpcs')->create('TBL_Calidadpcs_proceso_comunicacion', function (Blueprint $table) {
            $table->increments('PK_CPGC_Id_Comunicacion');
            $table->string('CPGC_Interesado');
            $table->string('CPGC_Lugar');
            $table->dateTime('CPGC_Fecha');
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
