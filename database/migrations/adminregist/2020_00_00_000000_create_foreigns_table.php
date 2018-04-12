<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignsTable extends Migration
{
    /**
     * Run the migrations to create foreign keys.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('adminregist')->table('TBL_Registros', function (Blueprint $table) {
            $table->string('FK_RE_Registro')->nullable();
            $table->integer('FK_RE_Novedad')->nullable()->unsigned();

            $table->foreign('FK_RE_Registro')->references('number_document')->on('developer.users_udec')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('FK_RE_Novedad')->references('PK_NOV_IdNovedad')->on('TBL_Novedades')
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

    }
}