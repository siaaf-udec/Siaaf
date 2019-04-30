<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObservacionesMctJurado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('gesap')->create('TBL_Observaciones_Mct_Jurado', function (Blueprint $table) {
            $table->increments('PK_Id_Observacion_Jurado');       
            $table->Integer('FK_NPRY_IdMctr008')->unsigned();
            $table->foreign('FK_NPRY_IdMctr008')
                  ->references('PK_NPRY_IdMctr008')
                  ->on('TBL_Anteproyecto')
                  ->onDelete('cascade');
            $table->Integer('FK_MCT_IdMctr008')->unsigned();
            $table->foreign('FK_MCT_IdMctr008')
                  ->references('PK_MCT_IdMctr008')
                  ->on('TBL_Mctr008')
                  ->onDelete('cascade');
            $table->BigInteger('FK_User_Codigo')->unsigned();
            $table->foreign('FK_User_Codigo')
                        ->references('PK_User_Codigo')
                        ->on('TBL_Usuario')
                        ->onDelete('cascade');
                        
            $table->Integer('OBS_Formato');
            $table->string('OBS_Observacion', 600);
            
          
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
        Schema::dropIfExists('TBL_Observaciones_mct_jurado');
    }
}
