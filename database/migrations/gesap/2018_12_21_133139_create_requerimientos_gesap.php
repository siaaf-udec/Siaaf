<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequerimientosGesap extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('gesap')->create('TBL_Requerimientos', function (Blueprint $table) {
            $table->increments('PK_RQMS_Id');
            $table->String('RQMS_Introduccion', 500);
            $table->String('RQMS_Descrip_General', 500);
            $table->String('RQMS_Requisitos_Especificos', 500);
            
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
        Schema::dropIfExists('TBL_Requerimientos');
    }
}
