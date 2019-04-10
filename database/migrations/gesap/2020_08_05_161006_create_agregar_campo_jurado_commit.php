<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgregarCampoJuradoCommit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('TBL_Observaciones_Mct_Jurado', function (Blueprint $table) {
            $table->integer('OBS_Entrega')->nullable()->after('OBS_Observacion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('TBL_Observaciones_Mct_Jurado', function (Blueprint $table) {
            $table->integer('OBS_Entrega');
          });
    }
}
