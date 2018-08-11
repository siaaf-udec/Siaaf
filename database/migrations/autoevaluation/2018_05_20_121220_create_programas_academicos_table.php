<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramasAcademicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection("autoevaluation")->create('TBL_Programas_Academicos', function (Blueprint $table) {
            $table->increments('PK_PAC_Id');
            $table->string("PAC_Nombre");
            $table->mediumText("PAC_Descripcion")->nullable();
            $table->integer("FK_PAC_Estado")->unsigned();
            $table->integer("FK_PAC_Facultad")->unsigned();
            $table->integer("FK_PAC_Sede")->unsigned();
            $table->integer("FK_PAC_TipoPograma")->unsigned();
            $table->timestamps();


            $table->foreign("FK_PAC_Estado")->references("PK_ESD_Id")->on("TBL_Estados")->onDelete('cascade');
            $table->foreign("FK_PAC_Facultad")->references("PK_FCD_Id")->on("TBL_Facultades")->onDelete('cascade');
            $table->foreign("FK_PAC_Sede")->references("PK_SDS_Id")->on("TBL_Sedes")->onDelete("cascade");
            $table->foreign("FK_PAC_TipoPograma")->references("PK_TPR_Id")->on("TBL_Tipo_Programas")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TBL_Programas_Academicos');
    }
}
