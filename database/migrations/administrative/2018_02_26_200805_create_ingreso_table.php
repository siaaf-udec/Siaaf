<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngresoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('administrative')->create('ingreso', function (Blueprint $table) {
            $table->string('number_document')->primary()->nullable();
            $table->string('username');
            $table->string('lastname');
            $table->enum('type_user', ['Estudiante', 'Docente', 'Externo']);
            $table->string('company')->nullable();
            $table->enum('place', ['Fusagasugá', 'Girardot', 'Ubaté', 'Chia', 'Chocontá', 'Facatativá', 'Soacha', 'Zipaquirá','Ninguna']);
            $table->string('number_phone');
            $table->string('email')->nullable();
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
        Schema::dropIfExists('ingreso');
    }
}
