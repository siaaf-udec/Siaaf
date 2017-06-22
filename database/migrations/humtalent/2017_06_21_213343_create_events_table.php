<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('humtalent')->create('TBL_Eventos', function (Blueprint $table) {
            $table->increments('PK_EVNT_IdEvento')->unsigned()->unique();
            $table->String('EVNT_Descripcion',300);
            $table->date('EVNT_Fecha');
            $table->time('EVNT_Hora');
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
        Schema::dropIfExists('TBL_Eventos');
    }
}
