<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProyectoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('gesap')->create('TBL_Proyecto', function (Blueprint $table) {
            $table->increments('PK_PRYT_IdProyecto');
            $table->enum('PRYT_Estado', ['EN CURSO','TERMINADO'])->default('EN CURSO');
            $table->integer('FK_TBL_Anteproyecto_Id')->unsigned();
            $table->foreign('FK_TBL_Anteproyecto_Id')
                ->references('PK_NPRY_IdMctr008')
                ->on('TBL_Anteproyecto')
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
        Schema::dropIfExists('TBL_Proyecto');
    }
}
