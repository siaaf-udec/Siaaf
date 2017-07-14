<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObservacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('gesap')->create('tbl_observaciones', function (Blueprint $table) {
            $table->increments('PK_BVCS_idObservacion');
            $table->string('BVCS_Observacion');
            $table->integer('FK_TBL_Anteproyecto_id')->unsigned();
            $table->foreign('FK_TBL_Anteproyecto_id')->references('PK_NPRY_idMinr008')->on('TBL_Anteproyecto')->onDelete('cascade');
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
        Schema::dropIfExists('tbl_observaciones');
    }
}
