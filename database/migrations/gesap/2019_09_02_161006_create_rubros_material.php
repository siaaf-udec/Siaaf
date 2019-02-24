<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRubrosMaterial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('gesap')->create('TBL_RBR_Material', function (Blueprint $table) {
            $table->increments('PK_RBR_Material');
            $table->String('RBR_MTL_Descripcion');
            $table->String('RBR_MTL_Justificacion');
            $table->String('RBR_MTL_Cantidad');
            $table->String('RBR_MTL_Val');
            $table->String('RBR_MTL_Solicitado_Udec');
            $table->String('RBR_MTL_Contra_Udec');
            $table->String('RBR_MTL_Contra_Otro');
            $table->String('RBR_MTL_Total');
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
        Schema::dropIfExists('TBL_RBR_Material');
    }
}
