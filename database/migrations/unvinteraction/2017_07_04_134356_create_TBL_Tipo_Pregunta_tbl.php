<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTBLTipoPreguntaTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('unvinteraction')->create('TBL_Tipo_Pregunta', function (Blueprint $table) {
            $table->increments('PK_TPPG_Tipo_Pregunta');
            $table->text('TPPG_Tipo');
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
        Schema::dropIfExists('TBL_Tipo_Pregunta');
    }
}
