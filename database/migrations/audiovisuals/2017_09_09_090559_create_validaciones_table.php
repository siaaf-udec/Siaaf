<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValidacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('audiovisuals')->create('TBL_Validaciones', function (Blueprint $table) {
			//$table->dates=\Carbon\Carbon::now();
        	$table->increments('id'); //id Pregunta
            $table->string('VAL_PRE_Nombre');//Nombre Pregunta
            $table->integer('VAL_PRE_Valor')->unsigned()->nullable(); //->Valor Pregunta


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
        Schema::dropIfExists('TBL_Validaciones');
    }
}
