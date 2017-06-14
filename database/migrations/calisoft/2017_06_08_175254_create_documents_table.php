<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_Documentos', function (Blueprint $table) {
            $table->increments('PK_id');
            $table->string('url');
            $table->integer('FK_ProyectoId')->unsigned();
            $table->integer('FK_TipoDocumentoId')->unsigned();
            $table->timestamps();

            $table->foreign('FK_ProyectoId')->references('PK_id')->on('TBL_Proyectos')->onDelete('cascade');
            $table->foreign('FK_TipoDocumentoId')->references('PK_id')->on('TBL_TiposDocumento')->onDelete('cascade');
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
