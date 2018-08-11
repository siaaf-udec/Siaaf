<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcesosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection("autoevaluation")->create('TBL_Procesos', function (Blueprint $table) {
            $table->increments('PK_PCS_Id');
            $table->string("PCS_Nombre");
            $table->date("PCS_FechaInicio");
            $table->date("PCS_FechaFin");
            $table->integer("FK_PCS_Sede")->unsigned();
            $table->integer("FK_PCS_Programa")->unsigned()->nullable();
            $table->integer("FK_PCS_Fase")->unsigned();

            $table->timestamps();

            $table->foreign("FK_PCS_Sede")->references("PK_SDS_Id")->on("TBL_Sedes")->onDelete("cascade");
            $table->foreign("FK_PCS_Programa")->references("PK_PAC_Id")->on("TBL_Programas_Academicos")->onDelete("cascade");
            $table->foreign("FK_PCS_Fase")->references("PK_FSS_Id")->on("TBL_Fases")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TBL_Procesos');
    }
}
