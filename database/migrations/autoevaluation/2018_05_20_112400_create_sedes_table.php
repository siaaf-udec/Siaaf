<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSedesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection("autoevaluation")->create('TBL_Sedes', function (Blueprint $table) {
            $table->increments('PK_SDS_Id');
            $table->string("SDS_Nombre");
            $table->mediumText("SDS_Descripcion")->nullable();
            $table->integer("FK_SDS_Estado")->unsigned();
            $table->timestamps();

            $table->foreign("FK_SDS_Estado")->references("PK_ESD_Id")->on("TBL_Estados")->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TBL_Sedes');
    }
}
