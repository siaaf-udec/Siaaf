<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProyectoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('calidadpcs')->create('TBL_Calidadpcs_proyecto', function (Blueprint $table) {
            $table->integer('PK_CP_Id_proyecto')->unique()->primary();
            $table->String('CP_Id_proceso');
            $table->String('CP_Id_usuario');
            $table->String('CP_Id_etapa');
            $table->String('CP_nombre_etapa');
            $table->String('CP_progreso_etapa');
            $table->String('CP_estado_etapa');
            $table->String('CP_progreso_general'); 
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
        Schema::dropIfExists('TBL_Calidadpcs_proyecto');
    }
}
