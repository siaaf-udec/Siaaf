<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistroMantenimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('acadspace')->create('tbl_registro_mantenimientos', function (Blueprint $table) {
            $table->increments('pk_id_registro_mantenimiento')->unsigned()->unique();
            $table->datetime('fecha_inicio')->useCurrent();
            $table->datetime('fecha_fin')->nullable();
            $table->text('descripcion_mantenimiento')->nullable();
            $table->text('descripcion_errores')->nullable();
            $table->string('nombre_tecnico',120);
            $table->integer('fk_id_hojavida')->unsigned();
            $table->integer('fk_id_tipo_mantenimiento')->unsigned();
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
        Schema::dropIfExists('tbl_registro_mantenimientos');
    }
}