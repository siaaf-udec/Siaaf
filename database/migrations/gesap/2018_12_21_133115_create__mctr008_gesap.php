<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMctr008Gesap extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('gesap')->create('TBL_Mctr008', function (Blueprint $table) {
            $table->increments('PK_MCT_IdMctr008');
            $table->String('MCT_Actividad', 50);
            $table->String('MCT_descripcion', 500);
            

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
        Schema::dropIfExists('TBL_GESAP_Mctr008');
    }
}
