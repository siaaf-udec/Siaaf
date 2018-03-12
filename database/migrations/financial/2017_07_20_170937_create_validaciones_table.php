<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateValidacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('financial')->create('validaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('validation_realization_date');
            $table->unsignedInteger('validation_subject_id');
            $table->unsignedTinyInteger('validation_status_id');
            $table->unsignedTinyInteger('validation_cost_id');
            $table->unsignedBigInteger('validation_student_id');
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
        Schema::dropIfExists('validaciones');
    }
}
