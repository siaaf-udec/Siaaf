<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('audiovisuals')->create('TBL_Kits', function (Blueprint $table) {
            $table->increments('id');
            $table->text('KIT_Nombre');
			$table->integer('KIT_FK_Estado_id')->unsigned();
            $table->integer('KIT_FK_Tiempo')->unsigned()->nullable();
            $table->integer('KIT_Codigo')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TBL_Kits');
    }
}
