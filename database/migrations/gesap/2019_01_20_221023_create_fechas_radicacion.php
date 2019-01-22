<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFechasRadicacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('gesap')->create('TBL_fechas_radicacion', function (Blueprint $table) {
            $table->increments('PK_Id_Radicacion');
            $table->date('FCH_Radicacion_principal');
            $table->date('FCH_Radicacion_secundaria');

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
        Schema::dropIfExists('TBL_fechas_radicacion');
    }
}
