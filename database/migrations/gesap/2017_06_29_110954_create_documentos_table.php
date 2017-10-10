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
        Schema::connection('gesap')->create('tbl_Documentos', function (Blueprint $table) {
            $table->increments('PK_DMNT_IdProyecto');
            $table->string('DMNT_Estado',30);
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
