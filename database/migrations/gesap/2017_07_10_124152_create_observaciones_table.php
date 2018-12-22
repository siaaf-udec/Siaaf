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
        Schema::connection('gesap')->create('TBL_Observaciones', function (Blueprint $table) {
            $table->increments('PK_BVCS_IdObservacion');
            $table->string('BVCS_Observacion', 600);
            $table->integer('FK_TBL_Encargado_Id')->unsigned();
            $table->foreign('FK_TBL_Encargado_Id')
                ->references('PK_IdCargo')
                ->on('TBL_Encargados')
                ->onDelete('cascade');
            $table->date('Fecha_Observacion');
            $table->date('Fecha_Lim_Correcion_Observacion');
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
        Schema::dropIfExists('TBL_observaciones');
    }
}
