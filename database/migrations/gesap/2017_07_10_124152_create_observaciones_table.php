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
            $table->string('BVCS_Observacion',600);
            $table->integer('FK_TBL_Encargado_id')->unsigned();
            $table->foreign('FK_TBL_Encargado_id')->references('PK_NPRY_idCargo')->on('TBL_Encargados')->onDelete('cascade');
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
