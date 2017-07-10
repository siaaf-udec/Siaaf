<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnteproyectoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('gesap')->create('TBL_Anteproyecto', function (Blueprint $table) {
            $table->increments('PK_NPRY_idMinr008');
            $table->string('NPRY_Titulo',250);
            $table->String('NPRY_Keywords',300);
            $table->integer('NPRY_Duracion');
            $table->date('NPRY_FechaR',90);
            $table->date('NPRY_FechaL',90);
            $table->String('NPRY_Estado',90)->default("EN ESPERA");
            $table->integer('FK_TBL_Radicacion_id')->unsigned();
            $table->foreign('FK_TBL_Radicacion_id')->references('PK_RDCN_idRadicacion')->on('TBL_Radicacion')->delete();
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
        //
    }
}
