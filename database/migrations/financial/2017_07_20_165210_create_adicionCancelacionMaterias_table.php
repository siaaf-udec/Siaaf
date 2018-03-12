<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdicionCancelacionMateriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('financial')->create('adicionCancelacionMaterias', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('action_subject', ['activo', 'pendiente']);
            $table->unsignedInteger('subject_id');
            $table->unsignedBigInteger('student_id');
            $table->unsignedTinyInteger('status_subject_id');
            $table->unsignedTinyInteger('add_sub_cost_id');
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
        Schema::dropIfExists('adicionCancelacionMaterias');
    }
}
