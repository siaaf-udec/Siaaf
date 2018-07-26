<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection("autoevaluation")->create('TBL_Roles', function (Blueprint $table) {
            $table->increments('PK_ROL_Id');
            $table->string("ROL_Nombre");
            $table->mediumText("ROL_Descripcion")->nullable();
            $table->integer("FK_ROL_Estado")->unsigned();
            $table->timestamps();

            $table->foreign("FK_ROL_Estado")->references("PK_ESD_Id")->on("TBL_Estados")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TBL_Roles');
    }
}
