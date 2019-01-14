<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Desarrolladores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('gesap')->create('TBL_desarrolladores', function (Blueprint $table) {
            $table->increments('PK_Id_desarrollo');
            $table->Integer('FK_NPRY_IdMctr008')->unsigned();
            $table->foreign('FK_NPRY_IdMctr008')
                ->references('PK_NPRY_IdMctr008')
                ->on('TBL_Usuario')
                ->onDelete('cascade');
            $table->bigInteger('FK_User_Codigo')->unsigned();
            $table->foreign('PK_User_Codigo')
                ->references('PK_User_Codigo')
                ->on('TBL_Usuario')
                ->onDelete('cascade');
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TBL_desarrolladores');
    }
}
