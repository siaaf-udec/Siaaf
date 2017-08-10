<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_Artiuclos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('FK_tipo_id');
            $table->String('descripcion');
            $table->integer('FK_kit_id');
            $table->integer('FK_estado_id');
            $table->timestamps();

            $table->foreign('FK_tipo_id')->references('id')->on('TBL_Tipoarticulos')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('FK_kit_id')->references('id')->on('TBL_Kits')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('FK_estado_id')->references('id')->on('TBL_Estados')
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
        Schema::dropIfExists('articles');
    }
}
