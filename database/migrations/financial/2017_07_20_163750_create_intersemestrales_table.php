<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntersemestralesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('financial')->create('intersemestrales', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('intersemestral_status', ['activo', 'pendiente']);
            $table->unsignedInteger('intersemestral_subject_id');
            $table->unsignedTinyInteger('intersemestral_cost_id');
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
        Schema::dropIfExists('intersemestrales');
    }
}
