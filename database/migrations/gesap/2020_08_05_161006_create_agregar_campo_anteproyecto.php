<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgregarCampoAnteproyecto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('TBL_Anteproyecto', function (Blueprint $table) {
            $table->string('NPRY_Semillero',100)->after('NPRY_FCH_Radicacion');
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
            $table->string('NPRY_Semillero');
          });
    }
}
