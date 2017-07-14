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
            $table->increments('PK_PRYT_idProyecto');
            $table->string('PRYT_Estado',30);
            $table->integer('FK_TBL_Proyecto_id')->unsigned();
            $table->foreign('FK_TBL_Proyecto_id')->references('PK_PRYT_idProyecto')->on('TBL_proyecto')->onDelete('cascade');
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
