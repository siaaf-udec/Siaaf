<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatetipoMantenimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('acadspace')->create('tbl_tipo_mantenimientos', function (Blueprint $table) {
            $table->increments('pk_id_tipo_mantenimiento')->unsigned()->unique();
            $table->string('nombre_mantenimiento',50);
            $table->string('descripcion_tipo_mantenimiento',450);                        
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
        Schema::dropIfExists('tbl_tipo_mantenimiento');
    }
}