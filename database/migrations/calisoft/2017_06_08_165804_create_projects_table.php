<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('calisoft')->create('TBL_Proyectos', function (Blueprint $table) {
            $table->increments('PK_id');
            $table->string('nombre')->unique();
            $table->integer('FK_GrupoDeInvestigacionId')->unsigned();
            $table->integer('FK_SemilleroId')->unsigned();
            $table->integer('FK_CategoriaId')->unsigned();
            $table->timestamps();

            $table->foreign('FK_GrupoDeInvestigacionId')->references('PK_id')
                ->on('TBL_GruposDeInvestigacion')->onDelete('cascade');

            $table->foreign('FK_SemilleroId')->references('PK_id')
                ->on('TBL_Semilleros')->onDelete('cascade');

            $table->foreign('FK_CategoriaId')->references('PK_id')
                ->on('TBL_Categorias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TBL_Proyectos');
    }
}
