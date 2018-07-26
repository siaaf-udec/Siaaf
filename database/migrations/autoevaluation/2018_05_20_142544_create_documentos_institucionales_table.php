<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentosInstitucionalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection("autoevaluation")->create('TBL_Documentos_Institucionales', function (Blueprint $table) {
            $table->increments('PK_DOI_Id');
            $table->string("DOI_Nombre");
            $table->mediumText("DOI_Descripcion")->nullable();
            $table->string("link")->nullable();
            $table->integer("FK_DOI_Archivo")->unsigned()->nullable();
            $table->integer("FK_DOI_GrupoDocumento")->unsigned();
            $table->timestamps();

            $table->foreign("FK_DOI_Archivo")->references("PK_ACV_Id")->on("TBL_Archivos")->onDelete("cascade");
            $table->foreign("FK_DOI_GrupoDocumento")->references("PK_GRD_Id")->on("TBL_Grupos_Documentos")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TBL_Documentos_Institucionales');
    }
}
