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
        Schema::connection('adminis')->table('registro_ingreso', function (Blueprint $table) {
            $table->string('id_registro')->nullable();
            $table->integer('id_proceso')->nullable()->unsigned();

            $table->foreign('id_registro')->references('number_document')->on('ingreso')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_proceso')->references('id')->on('proceso')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::connection('adminis')->table('proceso', function (Blueprint $table) {
            $table->integer('id_macro')->nullable()->unsigned();

            $table->foreign('id_macro')->references('id')->on('macroproceso')
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