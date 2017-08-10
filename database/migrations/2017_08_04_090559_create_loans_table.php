<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->increments('id');

            $table->data('PRT_Fecha_Inicio');
            $table->data('PRT_Fecha_Fin');
            $table->string('PRT_Observacion_Entrega');
            $table->string('PRT_Observacion_Recibe');

            $table->integer('PRT_FK_PRT_Articulos_id'); //->numeroArticulos
            $table->integer('PRT_FK_Usuario_id'); //funcionario
            $table->integer('PRT_FK_Kits_id'); //->numeroKits
            $table->integer('PRT_FK_Estado');
            $table->integer('PRT_FK_Usuario_Entrega'); //administradores
            $table->integer('PRT_FK_Usuario_Recibe'); //administradores
            //relaciones
            $table->foreign('FK_FUNCIONARIO_Programa')->references('id')->on('carreras');
            $table->foreing('PRT_FK_PRT_Articulos_id')->references('id')->on('carreras');; //->numeroArticulos
            $table->foreing('PRT_FK_Usuario_id')->references('id')->on('carreras');;
            $table->foreing('PRT_FK_Kits_id')->references('id')->on('carreras');; //->numeroKits
            $table->foreing('PRT_FK_Estado')->references('id')->on('carreras');;
            $table->foreing('PRT_FK_Usuario_Entrega')->references('id')->on('carreras');;
            $table->foreing('PRT_FK_Usuario_Recibe')->references('id')->on('carreras');;

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
        Schema::dropIfExists('loans');
    }
}
