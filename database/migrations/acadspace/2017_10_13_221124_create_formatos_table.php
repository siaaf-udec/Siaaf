<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('acadspace')->create('TBL_Formatos', function (Blueprint $table) {
            $table->increments('PK_FAC_Id_Formato')->unsigned()->unique();
            $table->string('FAC_Titulo_Doc',50);
            $table->string('FAC_Descripcion_Doc',255);
            $table->string('FAC_Nombre_Doc',255);
            $table->string('FAC_Correo',100);
            $table->integer('FAC_Estado')->unsigned();
            $table->integer('FK_FAC_Id_Secretaria')->unsigned();
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
        Schema::dropIfExists('TBL_Formatos');
    }
}
