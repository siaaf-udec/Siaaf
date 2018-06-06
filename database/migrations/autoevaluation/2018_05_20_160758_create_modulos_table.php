<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection("autoevaluation")->create('TBL_Modulos', function (Blueprint $table) {
            $table->increments('PK_MDL_Id');
            $table->string("MDL_Nombre");
            $table->mediumText("MDL_Descripcion")->nullable();
            $table->mediumText("MDL_Ruta")->nullable();
            $table->integer("FK_MDL_Estado")->unsigned();
            $table->timestamps();

            $table->foreign("FK_MDL_Estado")->references("PK_ESD_Id")->on("TBL_Estados")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TBL_Modulos');
    }
}
