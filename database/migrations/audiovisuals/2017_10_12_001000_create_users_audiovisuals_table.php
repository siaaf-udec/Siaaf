<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('developer')->create('TBL_User_Audiovisual', function (Blueprint $table) {
            $table->increments('id');
            $table->text('url');
            /*
             * imageble por el nombre del metodo en
             * las relaciones del modelo.
             * */
            $table->integer('audiovisualble_id'); //Toma el id de la tabla pages o posts
            $table->string('audiovisualble_type'); //Guarda la entidad ya sea pages o posts

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
        Schema::dropIfExists('TBL_User_Audiovisual');
    }
}
