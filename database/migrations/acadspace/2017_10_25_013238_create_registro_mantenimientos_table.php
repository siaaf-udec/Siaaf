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
        Schema::connection('acadspace')->create('TBL_Registro_Mantenimientos', function (Blueprint $table) {
            $table->increments('PK_MANT_Id_Registro')->unsigned()->unique();
            $table->datetime('MANT_Fecha_Inicio')->useCurrent();
            $table->datetime('MANT_Fecha_Fin')->nullable();
            $table->text('MANT_Descripcion')->nullable();
            $table->text('MANT_Descripcion_Errores')->nullable();
            $table->string('MANT_Nombre_Tecnico',120);
            $table->integer('FK_MANT_Id_Hojavida')->unsigned();
            $table->integer('FK_MANT_Id_Tipo')->unsigned();
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
        Schema::dropIfExists('TBL_Registro_Mantenimientos');
    }
}