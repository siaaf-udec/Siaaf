<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('gesap')->create('TBL_Documentos', function (Blueprint $table) {
            $table->increments('PK_DMNT_IdProyecto');
            $table->String('DMNT_Nombre',50);
            $table->String('DMNT_Descripcion',100);
            $table->String('DMNT_Archivo')->nullable();
            $table->integer('FK_TBL_Proyecto_Id')->unsigned();
            $table->foreign('FK_TBL_Proyecto_Id')->references('PK_PRYT_IdProyecto')->on('TBL_Proyecto')->onDelete('cascade');
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
        Schema::dropIfExists('TBL_Documentos');
    }
}
