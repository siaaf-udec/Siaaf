<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaracteristicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection("autoevaluation")->create('TBL_Caracteristicas', function (Blueprint $table) {
            $table->increments('PK_CRT_Id');
            $table->string("CRT_Nombre");
            $table->mediumText("CRT_Descripcion")->nullable();
            $table->integer("CRT_Identificador");
            $table->integer("FK_CRT_Factor")->unsigned();
            $table->integer("FK_CRT_Estado")->unsigned();
            $table->integer("FK_CRT_Ambito")->unsigned();
            $table->timestamps();

            $table->foreign("FK_CRT_Factor")->references("PK_FCT_Id")->on("TBL_Factores")->onDelete("cascade");
            $table->foreign("FK_CRT_Estado")->references("PK_ESD_Id")->on("TBL_Estados")->onDelete("cascade");
            $table->foreign("FK_CRT_Ambito")->references("PK_AMB_Id")->on("TBL_Ambitos_Responsabilidad")->onDelete("cascade");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TBL_Caracteristicas');
    }
}
