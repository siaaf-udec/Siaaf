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
            $table->increments('PK_RPST_IdMinr008');
            $table->string('RPST_RMin');
            $table->string('RPST_Requerimientos');
            $table->integer('FK_TBL_Observaciones_Id')->unsigned();
            $table->foreign('FK_TBL_Observaciones_Id')
                ->references('PK_BVCS_IdObservacion')
                ->on('TBL_Observaciones')
                ->onDelete('cascade');
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
