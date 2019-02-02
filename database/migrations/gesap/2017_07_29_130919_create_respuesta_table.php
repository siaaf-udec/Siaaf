<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespuestaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('gesap')->create('TBL_Respuesta', function (Blueprint $table) {
            $table->increments('PK_RPST_IdMctr008');
            $table->string('RPST_RMct');
            $table->string('RPST_Requerimientos');
            $table->integer('FK_TBL_Observaciones_Id')->unsigned();
           
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
        Schema::dropIfExists('TBL_Respuesta');
    }
}
