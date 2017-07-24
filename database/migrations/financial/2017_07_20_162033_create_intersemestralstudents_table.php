<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntersemestralstudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('financial')->create('intersemestralstudents', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('intersemestral_id');
            $table->unsignedInteger('student_id');
            $table->unsignedInteger('student_status_id');
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
        Schema::dropIfExists('intersemestralstudents');
    }
}
