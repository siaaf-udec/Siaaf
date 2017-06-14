<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('calisoft')->create('TBL_Pruebas', function (Blueprint $table) {
            $table->increments('PK_id');
            $table->string('nombre');
            $table->integer('FK_CasoPruebaId')->unsigned();
            $table->timestamps();

            $table->foreign('FK_CasoPruebaId')->references('PK_id')->on('TBL_CasoPrueba')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TBL_Pruebas');
    }
}
