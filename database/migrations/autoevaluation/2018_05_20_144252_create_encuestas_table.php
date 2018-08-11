<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEncuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection("autoevaluation")->create('TBL_Encuestas', function (Blueprint $table) {
            $table->increments('PK_ECT_Id');
            $table->dateTime("ECT_FechaPublicacion");
            $table->dateTime("ECT_FechaFinalizacion");
            $table->boolean("ENC_EstadoPublicacion");
            $table->integer("FK_ECT_Proceso")->unsigned();
            $table->integer("FK_ECT_DatosEncuesta")->unsigned();
            $table->timestamps();

            $table->foreign("FK_ECT_Proceso")->references("PK_PCS_Id")->on("TBL_Procesos")->onDelete("cascade");
            $table->foreign("FK_ECT_DatosEncuesta")->references("PK_DAE_Id")->on("TBL_Datos_Encuestas")->onDelete("cascade");


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TBL_Encuestas');
    }
}
