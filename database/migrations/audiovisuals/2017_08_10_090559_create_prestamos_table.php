<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrestamosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('audiovisuals')->create('TBL_Prestamos', function (Blueprint $table) {
			$table->dates=\Carbon\Carbon::now();
        	$table->increments('id'); //id prestamo
            $table->integer('PRT_FK_Articulos_id')->unsigned()->nullable(); //->idArticulos
            $table->integer('PRT_FK_Funcionario_id')->unsigned(); //funcionario
            $table->integer('PRT_FK_Kits_id')->unsigned(); //->id kits
            $table->dateTime('PRT_Fecha_Inicio'); //reserva y prestamo
            $table->dateTime('PRT_Fecha_Fin'); //reserva y prestamo
            $table->string('PRT_Observacion_Entrega');
            $table->string('PRT_Observacion_Recibe');
            $table->integer('PRT_FK_Estado')->unsigned(); // pendiente aprobado o rechazado
            $table->integer('PRT_FK_Tipo_Solicitud')->unsigned(); // prestamo o reserva
            $table->integer('PRT_FK_Administrador_Entrega_id')->unsigned(); //administradores
            $table->integer('PRT_FK_Administrador_Recibe_id')->unsigned(); //administradores

            //relaciones
            //$table->foreign('PRT_FK_Articulos_id')->references('id')->on('TBL_Articulos'); //->numeroArticulos
            /*$table->foreign('PRT_FK_Funcionario_id')->references('id')->on('TBL_Usuario_Audiovisuales');
            $table->foreign('PRT_FK_Kits_id')->references('id')->on('TBL_Kits');
            $table->foreign('PRT_FK_Estado')->references('id')->on('TBL_Estados'); //->numeroKits
            $table->foreign('PRT_FK_Tipo_Solicitud')->references('id')->on('TBL_Tipos_solicitud');
            $table->foreign('PRT_FK_Administrador_Entrega_id')->references('id')->on('TBL_Usuario_Audiovisuales');
            $table->foreign('PRT_FK_Administrador_Recibe_id')->references('id')->on('TBL_Usuario_Audiovisuales');*/

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
        Schema::dropIfExists('TBL_Prestamos');
    }
}
