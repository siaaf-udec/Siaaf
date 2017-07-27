<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('developer')->create('regions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('code', 10);
            $table->integer('country_id')->unsigned();

            $table->timestamps();

            $table->foreign('country_id')->references('id')->on('countries')
                  ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regions');
    }
}
