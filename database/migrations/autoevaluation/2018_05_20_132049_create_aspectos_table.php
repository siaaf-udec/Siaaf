<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAspectosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection("autoevaluation")->create('TBL_Aspectos', function (Blueprint $table) {
            $table->increments('PK_ASP_Id');
            $table->string("ASP_Nombre");
            $table->mediumText("ASP_Descripcion")->nullable();
            $table->integer("ASP_Identificador");
            $table->integer("FK_ASP_Carateristica")->unsigned();
            $table->timestamps();

            $table->foreign("FK_ASP_Carateristica")->references("PK_CRT_Id")->on("TBL_Caracteristicas")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TBL_Aspectos');
    }
}
