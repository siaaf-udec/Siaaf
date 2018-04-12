<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcesoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('administrative')->create('proceso', function (Blueprint $table) {
            $table->increments('id');
<<<<<<< Updated upstream:database/migrations/administrative/2018_02_28_111619_create_proceso_table.php
            $table->string('nombre_proceso');
            $table->timestamps();
=======
            $table->String('KIT_Nombre');
			$table->integer('KIT_FK_Estado_id')->unsigned();
            $table->integer('KIT_FK_Tiempo')->unsigned()->nullable();
            $table->integer('KIT_Codigo')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();

>>>>>>> Stashed changes:database/migrations/audiovisuals/2017_08_09_010709_create_kits_table.php
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proceso');
    }
}
