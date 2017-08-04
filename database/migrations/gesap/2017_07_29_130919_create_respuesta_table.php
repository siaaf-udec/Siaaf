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
        Schema::connection('gesap')->create('tbl_respuesta', function (Blueprint $table) {
            $table->increments('PK_RPST_idMinr008');
            $table->string('RPST_RMin');
            $table->string('RPST_Requerimientos');
            $table->integer('FK_TBL_Observaciones_id')->unsigned();
            $table->foreign('FK_TBL_Observaciones_id')->references('PK_BVCS_idObservacion')->on('tbl_observaciones')->onDelete('cascade');
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
     Schema::dropIfExists('tbl_respuesta');
    }
}
