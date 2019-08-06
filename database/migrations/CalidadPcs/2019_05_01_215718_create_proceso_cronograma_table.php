<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcesoCronogramaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('calidadpcs')->create('TBL_Calidadpcs_proceso_cronograma', function (Blueprint $table) {
            $table->increments('PK_CPC_Id_Sprint');
            $table->string('CPC_Nombre_Sprint');
            $table->string('CPC_Requerimiento');
            $table->string('CPC_Recurso')->nullable();
            $table->integer('FK_CPP_Id_Proyecto')->unsigned();
            $table->foreign('FK_CPP_Id_Proyecto')->references('PK_CP_Id_Proyecto')->on('TBL_Calidadpcs_proyectos')->onDelete("cascade");
            
            
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
        Schema::dropIfExists('TBL_Calidadpcs_proceso_cronograma');
    }
}
