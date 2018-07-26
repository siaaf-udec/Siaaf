<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacultadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection("autoevaluation")->create('TBL_Facultades', function (Blueprint $table) {
            $table->increments('PK_FCD_Id');
            $table->string("FCD_Nombre");
            $table->mediumText("FCD_Descripcion")->nullable();
            $table->integer("FK_FCD_Estado")->unsigned();
            $table->timestamps();

            $table->foreign("FK_FCD_Estado")->references("PK_ESD_Id")->on("TBL_Estados")->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TBL_Facultades');
    }
}
