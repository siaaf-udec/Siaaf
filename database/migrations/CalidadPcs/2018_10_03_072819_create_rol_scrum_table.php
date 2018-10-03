<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolScrumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('calidadpcs')->create('TBL_Calidadpcs_rol_scrum', function (Blueprint $table) {
             $table->integer('CR_Id_rol_scrum')->unique()->primary();
            $table->String('CR_Nombre_rol_scrum');
            $table->datetime('CR_FHentrada');
            $table->timestamp('CR_FHsalida')->default(DB::raw('CURRENT_TIMESTAMP'));
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
        Schema::dropIfExists('TBL_Calidadpcs_rol_scrum');
    }
}
