<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFactoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection("autoevaluation")->create('TBL_Factores', function (Blueprint $table) {
            $table->increments('PK_FCT_Id');
            $table->string("FCT_Nombre");
            $table->mediumText("FCT_Descripcion")->nullable();
            $table->integer("FCT_Identificador");
            $table->integer("FK_FCT_Estado")->unsigned();
            $table->integer("FK_FCT_Ponderacion_factor")->unsigned();
            $table->integer("FK_FCT_Lineamiento")->unsigned();
            $table->timestamps();

            $table->foreign("FK_FCT_Estado")->references("PK_ESD_Id")->on("TBL_Estados")->onDelete("cascade");
            $table->foreign("FK_FCT_Ponderacion_factor")->references("PK_POF_Id")->on("TBL_Ponderacion_Factor")->onDelete("cascade");
            $table->foreign("FK_FCT_Lineamiento")->references("PK_LNM_Id")->on("TBL_Lineamientos")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TBL_Factores');
    }
}
