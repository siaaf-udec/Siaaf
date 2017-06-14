<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('calisoft')->create('TBL_EvaluacionDocumento', function (Blueprint $table) {
            $table->increments('PK_id');
            $table->boolean('checked');
            $table->text('observacion');
            $table->integer('FK_DocumentoId')->unsigned();
            $table->integer('FK_UsuarioId')->unsigned();
            $table->timestamps();

            $table->foreign('FK_DocumentoId')->references('PK_id')->on('TBL_Documentos')
                ->onDelete('cascade');

            $table->foreign('FK_UsuarioId')->references('PK_id')->on('TBL_Usuarios')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TBL_EvaluacionDocumento');
    }
}
