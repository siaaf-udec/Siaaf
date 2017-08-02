<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModMotosCKsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_Motos_Parks', function (Blueprint $table) {

            $table->String('PK_MT_Placa',6)->unique()->primary();
            $table->String('MT_Marca',50);
            $table->String('MT_Linea',50);
            $table->integer('MT_NTpropiedad')->unsigned();
            $table->integer('MT_Nsoat')->unsigned();
            $table->date('MT_FVsoat');
            $table->integer('FK_MT_Cedula')->unsigned()->unique();
            $table->integer('FK_MT_IdEstado')->unsigned()->unique();
            $table->foreign('FK_MT_Cedula')->references('PK_CK_Cedula')->on('TBL_User_Parks');
            $table->foreign('FK_MT_IdEstado')->references('PK_ES_IdEstado')->on('TBL_Estados_Parks');
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
        Schema::dropIfExists('TBL_Motos_Parks');
    }
}
