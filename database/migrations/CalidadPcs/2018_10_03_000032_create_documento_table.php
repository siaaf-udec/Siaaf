<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('calidadpcs')->create('TBL_Calidadpcs_documento', function (Blueprint $table) {
            $table->integer('PK_CD_Id_documento')->unique()->primary();
            $table->String('CD_Nombre_documento');
            $table->String('CD_url_documento');
            $table->datetime('CD_FHentrada');
            $table->timestamp('CD_FHsalida')->default(DB::raw('CURRENT_TIMESTAMP'));
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
        Schema::dropIfExists('TBL_Calidadpcs_documento');
    }
}
