<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcesosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('calidadpcs')->create('TBL_Calidadpcs_procesos', function (Blueprint $table) {
            $table->integer('PK_CP_Id_proceso')->unique()->primary();
            $table->String('CP_Id_etapa');
            $table->String('CP_Id_documento');
            $table->String('CP_Id_proyecto');
            $table->String('CP_nombre_proceso');
            $table->String('CP_estado_proceso'); 
            $table->datetime('CP_FHentrada');
            $table->timestamp('CP_FHsalida')->default(DB::raw('CURRENT_TIMESTAMP'));
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
        Schema::dropIfExists('TBL_Calidadpcs_procesos');
    }
}
