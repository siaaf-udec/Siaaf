<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::connection('audiovisuals')->create('telefono', function (Blueprint $table) {
            $table->integer('id')->unsigned()->unique()->primary();
            $table->integer('user_id')->unsigned();
			$table->string('nombre');

			$table->foreign('user_id')->references('id')->on('usuariopractica');
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
        Schema::dropIfExists('telefono');
    }
}
