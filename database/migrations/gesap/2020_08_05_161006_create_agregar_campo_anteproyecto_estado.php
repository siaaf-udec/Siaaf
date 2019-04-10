<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgregarCampoAnteproyectoEstado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('TBL_Anteproyecto', function (Blueprint $table) {
            $table->integer('NPRY_Ante_Estado')->nullable()->after('NPRY_Semillero');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('TBL_Anteproyecto', function (Blueprint $table) {
            $table->dropcolumn('NPRY_Ante_Estado');
          });
    }
}
