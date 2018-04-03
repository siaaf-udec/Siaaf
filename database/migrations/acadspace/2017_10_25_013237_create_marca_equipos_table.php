<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarcaEquiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('acadspace')->create('tbl_marca_equipos', function (Blueprint $table) {
            $table->increments('pk_id_marca_equipo')->unsigned()->unique();
            $table->string('tipo_marca',120);                        
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
        Schema::dropIfExists('tbl_marca_equipos');
    }
}