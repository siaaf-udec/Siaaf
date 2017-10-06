<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsistentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('humTalent')->create('TBL_Asistentes', function (Blueprint $table)  {
            $table->String('ASIST_Informe',10);
            $table->integer('FK_TBL_Eventos_IdEvento')->unsigned();
            $table->integer('FK_TBL_Persona_Cedula')->unsigned();
            $table->foreign('FK_TBL_Eventos_IdEvento')->references('PK_EVNT_IdEvento')->on('TBL_Eventos');
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
        Schema::dropIfExists('TBL_Asistentes');
    }
}
