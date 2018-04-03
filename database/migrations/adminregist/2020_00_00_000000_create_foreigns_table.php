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
        Schema::connection('adminregist')->table('registros', function (Blueprint $table) {
            $table->string('id_registro')->nullable();
            $table->integer('id_novedad')->nullable()->unsigned();

            $table->foreign('id_registro')->references('number_document')->on('developer.users_udec')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_novedad')->references('id')->on('novedades')
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