<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('gesap')->create('TBL_MCT_Resultados', function (Blueprint $table) {
            $table->increments('PK_Id_Resultados');
            $table->String('MCT_Resultado');
            $table->String('MCT_Producto_Esperado');
            $table->String('MCT_Indicador');
            $table->String('MCT_Beneficiario');
            $table->String('MCT_Categoria');
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
        Schema::dropIfExists('TBL_MCT_Financiacion');
    }
}
