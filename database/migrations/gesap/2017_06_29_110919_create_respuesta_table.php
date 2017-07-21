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
            $table->string('RPST_RMin',90);
            $table->String('RPST_Requerimientos',90);
            $table->integer('FK_TBL_Radicacion_id')->unsigned();
            $table->foreign('FK_TBL_Radicacion_id')->references('PK_RDCN_idRadicacion')->on('TBL_Radicacion')->onDelete('cascade');
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
