<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComentariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('acadspace')->create('TBL_Comentarios', function (Blueprint $table) {
            $table->increments('PK_COM_Id_Comentario')->unsigned()->unique();
            $table->text('COM_Comentario');
            $table->integer('FK_COM_Id_Solicitud')->unsigned();
            $table->foreign('FK_COM_Id_Solicitud')->references('PK_SOL_Id_Solicitud')->on('TBL_Solicitud');
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
        Schema::dropIfExists('TBL_Comentarios');
    }
}
