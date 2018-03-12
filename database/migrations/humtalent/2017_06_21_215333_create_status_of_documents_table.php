<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusOfDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('humtalent')->create('TBL_Estado_Documentacion', function (Blueprint $table) {
            $table->date('EDCMT_Fecha');
            $table->String('EDCMT_Proceso_Documentacion',60);
            $table->integer('FK_TBL_Persona_Cedula')->unsigned();
            $table->integer('FK_Personal_Documento')->unsigned()->nullable();
            $table->foreign('FK_TBL_Persona_Cedula')->references('PK_PRSN_Cedula')->on('TBL_Personas');
            $table->foreign('FK_Personal_Documento')->references('PK_DCMTP_Id_Documento')->on('TBL_Documentacion_Personal');
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
        Schema::dropIfExists('TBL_Estado_Documentacion');
    }
}
