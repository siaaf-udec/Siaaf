<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTBLEstadoTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('unvinteraction')->create('TBL_Estado', function (Blueprint $table) {
            $table->increments('PK_ETAD_Estado');
            $table->text('ETAD_Estado');
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
        //
        Schema::dropIfExists('TBL_Estado');
    }
}
