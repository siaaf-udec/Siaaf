<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection("autoevaluation")->create('TBL_Grupos', function (Blueprint $table) {
            $table->increments('PK_GRP_Id');
            $table->string("GRP_Nombre");
            $table->mediumText("GRP_Descripcion")->nullable();
            $table->string("GRP_Ruta");
            $table->integer("FK_GRP_Estados")->unsigned();
            $table->integer("FK_GRP_Modulos")->unsigned();

            $table->timestamps();

            $table->foreign("FK_GRP_Estados")->references("PK_ESD_Id")->on("TBL_Estados")->onDelete("cascade");
            $table->foreign("FK_GRP_Modulos")->references("PK_MDL_Id")->on("TBL_Modulos")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TBL_Grupos');
    }
}
