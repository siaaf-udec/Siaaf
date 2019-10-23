<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcesoParticipacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('calidadpcs')->create('TBL_Calidadpcs_proceso_interesados', function (Blueprint $table) {
            $table->increments('PK_CPI_Id_Interesados');
            $table->string('CPI_Necesidades');
            $table->text('CPI_Expectativas');
            $table->string('CPI_Participacion')->nullable();
            $table->text('CPI_Observaciones')->nullable();
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
        Schema::dropIfExists('TBL_Calidadpcs_proceso_interesados');
    }
}
