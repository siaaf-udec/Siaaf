<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRubrosPersonal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('gesap')->create('TBL_RBR_Personal', function (Blueprint $table) {
            $table->increments('PK_RBR_Personal');
            $table->String('RBR_PER_Nombre');
            $table->String('RBR_PER_Funcion');
            $table->String('RBR_PER_Tipo');
            $table->String('RBR_PER_Dedicacion');
            $table->String('RBR_PER_Entidad');
            $table->String('RBR_PER_Solicitado_Udec');
            $table->String('RBR_PER_Contra_Udec');
            $table->String('RBR_PER_Contra_Otro');
            $table->String('RBR_PER_Total');
            $table->Integer('FK_NPRY_IdMctr008')->unsigned();
            $table->foreign('FK_NPRY_IdMctr008')
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
        Schema::dropIfExists('TBL_RBR_Personal');
    }
}
