<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('gesap')->create('TBL_Actividades', function (Blueprint $table) {
            $table->increments('PK_CTVD_IdActividad');
            $table->String('CTVD_Nombre', 50);
            $table->String('CTVD_Descripcion', 100);
            $table->integer('CTVD_Default')->unsigned()->default(0);
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
        Schema::dropIfExists('TBL_Actividades');
    }
}
