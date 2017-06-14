<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_CasoPrueba', function (Blueprint $table) {
            $table->increments('PK_id');
            $table->string('nombre');
            $table->text('proposito');
            $table->text('alcance');
            $table->text('resultado_esperado');
            $table->text('criterios');
            $table->enum('prioridad', ['alta', 'media', 'baja']);
            $table->timestamp('limite');
            $table->text('formulario');
            $table->text('observacion');
            $table->enum('estado', ['evaluar', 'carga', 'terminado']);
            $table->integer('entrega');
            $table->integer('FK_ProyectoId')->unsigned();
            $table->integer('FK_UsuarioId')->unsigned();
            $table->timestamps();

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
        Schema::dropIfExists('TBL_CasoPrueba');
    }
}
