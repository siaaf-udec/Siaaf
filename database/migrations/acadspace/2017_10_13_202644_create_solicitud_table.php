<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitudTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('acadspace')->create('TBL_Solicitud', function (Blueprint $table) {
            $table->increments('PK_SOL_Id_Solicitud')->unsigned()->unique();
            $table->string('SOL_Guia_Practica',30);
            $table->string('SOL_Dias',50)->nullable();
            $table->string('SOL_Software',20)->nullable();
            $table->integer('SOL_Grupo')->unsigned();
            $table->integer('SOL_Cant_Estudiantes')->unsigned();
            $table->string('SOL_Hora_Inicio',10);
            $table->string('SOL_Hora_Fin',10);
            $table->integer('FK_SOL_Id_Docente')->unsigned();
            $table->integer('SOL_Estado')->unsigned();
            $table->string('SOL_Nucleo_Tematico',30);
            $table->string('FK_SOL_Id_Sala',10)->nullable();
            $table->string('SOL_fecha_inicial',10)->nullable();
            $table->integer('SOL_Id_Practica')->unsigned();
            $table->string('SOL_Carrera',30);
            $table->string('SOL_Espacio',50);
            $table->string('SOL_Rango_Fechas',25)->nullable();


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
        Schema::dropIfExists('TBL_Solicitud');
    }
}
