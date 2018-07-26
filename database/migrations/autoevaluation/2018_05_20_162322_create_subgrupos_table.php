<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubgruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection("autoevaluation")->create('TBL_Subgrupos', function (Blueprint $table) {
            $table->increments('PK_SGP_Id');
            $table->string("SGP_Nombre");
            $table->mediumText("SGP_Descripcion")->nullable();
            $table->string("SGP_Ruta");
            $table->integer("FK_SGP_Estados")->unsigned();
            $table->integer("FK_SGP_Grupos")->unsigned();
            $table->timestamps();

            $table->foreign("FK_SGP_Estados")->references("PK_ESD_Id")->on("TBL_Estados")->onDelete("cascade");
            $table->foreign("FK_SGP_Grupos")->references("PK_GRP_Id")->on("TBL_Grupos")->onDelete("cascade");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TBL_Subgrupos');
    }
}
