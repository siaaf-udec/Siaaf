<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('developer')->create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->text('url');
            /*
             * imageble por el nombre del metodo en
             * las relaciones del modelo.
             * */
            $table->integer('imageble_id'); //Toma el id de la tabla pages o posts
            $table->string('imageble_type'); //Guarda la entidad ya sea pages o posts

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
        Schema::dropIfExists('images');
    }
}
