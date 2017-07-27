<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

      Schema::table('subject_program', function (Blueprint $table) {
        $table->foreign('subject_id')
        ->references('subject_id')->on('supletorios')
        ->onUpdate('cascade')
        ->onDelete('cascade');
        $table->foreign('subject_id')
        ->references('subject_id')->on('adicionCancelacionMaterias')
        ->onUpdate('cascade')
        ->onDelete('cascade');
        $table->foreign('subject_id')
        ->references('validation_subject_id')->on('validaciones')
        ->onUpdate('cascade')
        ->onDelete('cascade');
        $table->foreign('program_id')
        ->references('id')->on('materiasProgram')
        ->onUpdate('cascade')
        ->onDelete('cascade');
        $table->foreign('user_id')
        ->references('user_id')->on('RolUser')
        ->onUpdate('cascade')
        ->onDelete('cascade');

      });



        Schema::table('permisosRoles', function (Blueprint $table) {
          $table->foreign('permisos_id')
          ->references('id')->on('permisos')
          ->onUpdate('cascade')
          ->onDelete('cascade');
          $table->foreign('role_id')
          ->references('role_id')->on('RolUser')
          ->onUpdate('cascade')
          ->onDelete('cascade');

        });


        Schema::table('RolUser', function (Blueprint $table) {
          $table->unsignedTinyInteger('user_id');
          $table->foreign('user_id')
          ->references('id')->on('usuariosU')
          ->onUpdate('cascade')
          ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('foreings', function (Blueprint $table) {
            //
        });
    }
}
