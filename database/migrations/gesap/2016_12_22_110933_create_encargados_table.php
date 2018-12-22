<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEncargadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('gesap')->create('TBL_Encargados', function (Blueprint $table) {
            $table->increments('PK_IdCargo');           
            $table->integer('FK_TBL_Anteproyecto_Id')->unsigned();
            $table->foreign('FK_TBL_Anteproyecto_Id')->references('PK_NPRY_IdMctr008')->on('TBL_Anteproyecto')->onDelete('cascade');
            $table->integer('FK_User_Id')->unsigned();
            $table->foreign('FK_User_Id')->references('PK_User_Codigo')->on('TBL_Usuario')->onDelete('cascade');
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
        Schema::dropIfExists('TBL_Encargados');
    }
}
