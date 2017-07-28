<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('humtalent')->create('TBL_Inducciones', function (Blueprint $table){
            $table->increments('PK_INDC_ID_Induccion')->unsigned()->unique();
            $table->String('INDC_ProcesoInduccion',45);
            $table->Integer('INDC_Aprobacion')->unsigned();
            $table->integer('FK_TBL_Persona_Cedula')->unsigned();
            $table->foreign('FK_TBL_Persona_Cedula')->references('PK_PRSN_Cedula')->on('TBL_Personas');
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
        Schema::dropIfExists('TBL_Inducciones');
    }
}
