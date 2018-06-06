<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentosAutoevaluacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection("autoevaluation")->create('TBL_Documentos_Autoevaluacion', function (Blueprint $table) {
            $table->increments('PK_DOA_Id');
            $table->string("DOA_Numero")->nullable();
            $table->year("DOA_Anio")->nullable();
            $table->string("DOA_Link")->nullable();
            $table->mediumText("DOA_DescripcionGeneral")->nullable();
            $table->mediumText("DOA_ContenidoEspecifico")->nullable();
            $table->mediumText("DOA_ContenidoAdicional")->nullable();
            $table->mediumText("DOA_Observaciones")->nullable();
            $table->integer("FK_DOA_Archivo")->unsigned()->nullable();
            $table->integer("FK_DOA_IndicadorDocumental")->unsigned();
            $table->integer("FK_DOA_TipoDocumento")->unsigned();
            $table->integer("FK_DOA_Dependencia")->unsigned();
            $table->integer("FK_DOA_Proceso")->unsigned();

            
            $table->timestamps();

            $table->foreign("FK_DOA_Archivo")->references("PK_ACV_Id")->on("TBL_Archivos")->onDelete("cascade");
            $table->foreign("FK_DOA_IndicadorDocumental")->references("PK_IDO_Id")->on("TBL_Indicadores_Documentales")->onDelete("cascade");
            $table->foreign("FK_DOA_TipoDocumento")->references("PK_TDO_Id")->on("TBL_Tipo_Documentos")->onDelete("cascade");
            $table->foreign("FK_DOA_Dependencia")->references("PK_DPC_Id")->on("TBL_Dependencias")->onDelete("cascade");
            $table->foreign("FK_DOA_Proceso")->references("PK_PCS_Id")->on("TBL_Procesos")->onDelete("cascade");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TBL_Documentos_Autoevaluacion');
    }
}
