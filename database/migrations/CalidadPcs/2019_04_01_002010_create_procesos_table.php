<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcesosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('calidadpcs')->create('TBL_Calidadpcs_procesos', function (Blueprint $table) {
            $table->increments('PK_CP_Id_Proceso');
            $table->String('CP_Nombre_Proceso');
            $table->integer('FK_CP_Id_Etapa')->unsigned();
            $table->foreign('FK_CP_Id_Etapa')->references('PK_CE_Id_Etapa')->on('TBL_Calidadpcs_etapa')->onDelete("cascade");
            
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
        Schema::dropIfExists('TBL_Calidadpcs_procesos');
    }
}
