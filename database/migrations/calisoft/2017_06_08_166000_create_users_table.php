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
        Schema::connection('calisoft')->create('TBL_Usuarios', function (Blueprint $table) {
            $table->increments('PK_id');
            $table->enum('state', ['active', 'request', 'disabled'])->default('disabled');
            $table->enum('role', ['admin', 'student', 'evaluator'])->defualt('student');
            $table->integer('FK_ProyectoId')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('FK_ProyectoId')->references('PK_id')->on('TBL_Proyectos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TBL_Usuarios');
    }
}
