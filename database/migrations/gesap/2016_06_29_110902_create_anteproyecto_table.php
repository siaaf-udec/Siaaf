<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnteproyectoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('gesap')->create('TBL_Anteproyecto', function (Blueprint $table) {
            $table->increments('PK_NPRY_IdMctr008');
            $table->string('NPRY_Titulo', 200);
            $table->String('NPRY_Keywords', 300);
            $table->String('NPRY_Descripcion', 500);
            $table->integer('NPRY_Duracion');
            $table->bigInteger('FK_NPRY_Pre_Director')->unsigned();
            $table->foreign('FK_NPRY_Pre_Director')
                ->references('PK_User_Codigo')
                ->on('TBL_Usuario')
                ->onDelete('cascade');
            $table->integer('FK_NPRY_Estado')->unsigned();
            $table->foreign('FK_NPRY_Estado')
                ->references('PK_EST_Id')
                ->on('tbl_Estado_Anteproyecto')
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
        Schema::dropIfExists('TBL_Anteproyecto');
    }
}
