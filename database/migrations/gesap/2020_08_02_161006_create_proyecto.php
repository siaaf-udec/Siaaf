<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProyecto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('gesap')->create('TBL_Proyecto', function (Blueprint $table) {
            $table->increments('PK_Id_Proyecto');
            $table->Integer('FK_NPRY_IdMctr008')->unsigned();
            $table->foreign('FK_NPRY_IdMctr008')
                  ->references('PK_NPRY_IdMctr008')
                  ->on('TBL_Anteproyecto')
                  ->onDelete('cascade');
            $table->integer('FK_EST_Id')->unsigned();
            $table->foreign('FK_EST_Id')
                ->references('PK_EST_Id')
                ->on('TBL_Estado_Anteproyecto')
                ->onDelete('cascade');
            $table->date('PYT_Fecha_Radicacion');
           
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
