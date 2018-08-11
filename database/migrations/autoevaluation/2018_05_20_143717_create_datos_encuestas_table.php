<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatosEncuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection("autoevaluation")->create('TBL_Datos_Encuestas', function (Blueprint $table) {
            $table->increments('PK_DAE_Id');
            $table->string("DAE_Titulo");
            $table->mediumText("DAE_Descripcion")->nullable();
            $table->integer("FK_DAE_GruposInteres")->unsigned();
            $table->timestamps();

            $table->foreign("FK_DAE_GruposInteres")->references("PK_GIT_Id")->on("TBL_Grupos_Interes")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TBL_Datos_Encuestas');
    }
}
