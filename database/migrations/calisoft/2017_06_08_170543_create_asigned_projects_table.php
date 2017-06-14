<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsignedProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_ProyectosAsignados', function (Blueprint $table) {
            $table->integer('FK_UsuarioId')->unsigned();
            $table->integer('FK_ProyectoId')->unsigned();
            $table->timestamps();

            $table->primary(['FK_UsuarioId', 'FK_ProyectoId']);
            $table->foreign('FK_UsuarioId')->references('PK_id')->on('TBL_Usuarios')->onDelete('cascade');
            $table->foreign('FK_ProyectoId')->references('PK_id')->on('TBL_Proyectos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TBL_ProyectosAsignados');
    }
}
