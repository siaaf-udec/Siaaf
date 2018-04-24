<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSugerenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_Sugerencias', function (Blueprint $table) {
            $table->increments('PK_SU_IdSugerencia');
            $table->text('SU_Pregunta');
            $table->text('SU_Username');
            $table->text('SU_Email');
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
        Schema::dropIfExists('TBL_Sugerencias');
    }
}
