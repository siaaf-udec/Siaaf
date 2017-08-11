<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReminderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('humtalent')->create('TBL_Notificaciones', function (Blueprint $table) {
            $table->increments('PK_NOTIF_Id_Notificacion')->unique();
            $table->integer('NOTIF_Estado_Notificacion')->unsigned();
            $table->date('NOTIF_Fecha')->nullable();
            $table->String('NOTIF_Descripcion',60)->nullable();
            $table->date('NOTIF_Fecha_Notificacion')->nullable();
            $table->integer('FK_TBL_Estado_Documentacion_Persona')->unsigned();
            $table->foreign('FK_TBL_Estado_Documentacion_Persona')->references('FK_TBL_Persona_Cedula')->on('TBL_Estado_Documentacion');

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
        Schema::dropIfExists('TBL_Notificaciones');
    }
}
