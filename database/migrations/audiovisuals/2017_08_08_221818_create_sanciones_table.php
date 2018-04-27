<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSancionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('audiovisuals')->create('TBL_Sanciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('FK_SNS_Id_Funcionario')->unsigned()->nullable();
            $table->integer('FK_SNS_Id_Administrador')->unsigned()->nullable();
            $table->dateTime('SNS_Fecha');
            $table->text('SNS_Descripcion');
            $table->integer('FK_SNS_Id_Tipo_Sancion')->unsigned()->nullable();
            $table->text('SNS_Costo');
            $table->integer('FK_SNS_Id_Solicitud')->unsigned()->nullable();
            $table->integer('SNS_Sancion_General')->unsigned()->nullable();
            $table->integer('SNS_Numero_Orden')->unsigned()->nullable();
            $table->integer('SNS_Estado_Cancelacion')->unsigned();
            $table->timestamps();
            $table->softDeletes();


            //$table->foreign('FK_SNS_Tipo')->references('id')->on('TBL_Tipo_Sanciones');
            //$table->foreign('FK_SNS_UsuarioPrestamo_id')->references('id')->on('TBL_Usuario_Audiovisuales');
            //$table->foreign('FK_SNS_UsuarioSancion_id')->references('id')->on('TBL_Usuario_Audiovisuales');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TBL_Sanciones');
    }
}
