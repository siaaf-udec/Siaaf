<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConceptosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('gesap')->create('tbl_conceptos', function (Blueprint $table) {
            $table->increments('PK_CNPT_Conceptos');
            $table->string('CNPT_Concepto');
            $table->string('CNPT_Tipo');
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
        Schema::dropIfExists('tbl_conceptos');
    }
}
