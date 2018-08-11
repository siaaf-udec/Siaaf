<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection("autoevaluation")->create('TBL_Actividades', function (Blueprint $table) {
            $table->increments('PK_ACT_Id');
            $table->string("ACT_Nombre");
            $table->mediumText("ACT_Descripcion")->nullable();
            $table->integer("FK_ACT_Roles")->unsigned();

            $table->integer("FK_ACT_Grupos")->unsigned();
            $table->integer("FK_ACT_Subgrupos")->unsigned();
            $table->integer("FK_ACT_Estado")->unsigned();
            $table->timestamps();

            $table->foreign("FK_ACT_Roles")->references("PK_ROL_Id")->on("TBL_Roles")->onDelete("cascade");
            $table->foreign("FK_ACT_Grupos")->references("PK_GRP_Id")->on("TBL_Grupos")->onDelete("cascade");
            $table->foreign("FK_ACT_Subgrupos")->references("PK_SGP_Id")->on("TBL_Subgrupos")->onDelete("cascade");
            $table->foreign("FK_ACT_Estado")->references("PK_ESD_Id")->on("TBL_Estados")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TBL_Actividades');
    }
}
