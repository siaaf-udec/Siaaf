<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJurados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('gesap')->create('TBL_jurados', function (Blueprint $table) {
            $table->increments('PK_Id_jurados');
            $table->Integer('FK_NPRY_IdMctr008')->unsigned();
            $table->foreign('FK_NPRY_IdMctr008')
                ->references('PK_NPRY_IdMctr008')
                ->on('TBL_Anteproyecto')
                ->onDelete('cascade');
            $table->bigInteger('FK_User_Codigo')->unsigned();
            $table->foreign('FK_User_Codigo')
                ->references('PK_User_Codigo')
                ->on('TBL_Usuario')
                ->onDelete('cascade');
            $table->integer('FK_NPRY_Estado')->unsigned();
            $table->foreign('FK_NPRY_Estado')
                    ->references('PK_EST_Id')
                    ->on('TBL_Estado_Anteproyecto')
                    ->onDelete('cascade');
            $table->integer('FK_NPRY_Estado_Proyecto')->unsigned();
            $table->foreign('FK_NPRY_Estado_Proyecto')
                    ->references('PK_EST_Id')
                    ->on('TBL_Estado_Anteproyecto')
                    ->onDelete('cascade');
            $table->String('JR_Comentario', 4000);
            $table->String('JR_Comentario_Proyecto', 4000);
           
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
        Schema::dropIfExists('TBL_jurados');
    }
}
