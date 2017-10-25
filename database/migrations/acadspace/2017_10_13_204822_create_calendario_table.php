<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalendarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('acadspace')->create('TBL_Calendario', function (Blueprint $table) {
            $table->increments('PK_CAL_Id')->unsigned()->unique();
            $table->datetime('CAL_Fecha_Ini');
            $table->datetime('CAL_Fecha_Fin')->nullable();
            $table->string('CAL_Color',30)->nullable();
            $table->mediumText('CAL_Titulo')->nullable();
            $table->integer('FK_CAL_Id_Sala')->unsigned();
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
        Schema::dropIfExists('TBL_Calendario');
    }
}
