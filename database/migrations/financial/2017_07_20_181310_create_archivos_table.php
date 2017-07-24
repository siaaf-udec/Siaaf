<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('financial')->create('archivos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('file_route', 50);
            $table->enum('file_status', ['activo', 'pendiente'] );
            $table->unsignedBigInteger('file_user_id');
            $table->unsignedInteger('file_type_id');
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
        Schema::dropIfExists('archivos');
    }
}
