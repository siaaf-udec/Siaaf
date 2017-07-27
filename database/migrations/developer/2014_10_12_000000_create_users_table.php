<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('developer')->create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('lastname');
            $table->date('birthday')->nullable();
            $table->enum('identity_type', ['C.C', 'T.I'])->nullable();
            $table->integer('identity_no')->nullable()->unsigned();
            $table->string('identity_expe_place')->nullable();
            $table->date('identity_expe_date')->nullable();
            $table->string('address')->nullable();
            $table->enum('sexo', ['Masculino', 'Femenino'])->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('state', ['Pendiente', 'Aprobado', 'Denegado'])->default('pendiente');

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
