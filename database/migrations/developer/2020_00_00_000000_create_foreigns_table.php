<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignsTable extends Migration
{
    /**
     * Run the migrations to create foreign keys.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('developer')->table('users', function (Blueprint $table) {
            $table->integer('cities_id')->nullable()->unsigned();
            $table->integer('countries_id')->nullable()->unsigned();
            $table->integer('regions_id')->nullable()->unsigned();

            $table->foreign('cities_id')->references('id')->on('cities')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('countries_id')->references('id')->on('countries')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('regions_id')->references('id')->on('regions')
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

    }
}