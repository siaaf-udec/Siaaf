<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTBLDocumentacionTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('unvinteraction')->create('TBL_Documentacion', function (Blueprint $table) {
            $table->increments('PK_DOCU_Documentacion');
            $table->text('DOCU_Nombre'); 
            $table->text('DOCU_Ubicacion'); 
            $table->integer('FK_TBL_Convenio_Id')->unsigned();
            $table->foreign('FK_TBL_Convenio_Id')->references('PK_CVNO_Convenio')->on('TBL_Convenio');
            $table->timestamps();
            $table->softDeletes();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::dropIfExists('TBL_Documentacion');
    }
}
