<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProyectosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('calidadpcs')->create('TBL_Calidadpcs_proyectos', function (Blueprint $table) {
            $table->increments('PK_CP_Id_Proyecto');
            $table->String('CP_Nombre_Proyecto');
            $table->date('CP_Fecha_Inicio');
            $table->date('CP_Fecha_Final')->nullable();
            $table->integer('CP_Duracion')->nullable();      
            $table->string('CP_Entidades')->nullable();      
            $table->bigInteger('FK_CP_Id_Usuario')->unsigned();
            $table->foreign('FK_CP_Id_Usuario')->references('PK_CU_Id_Usuario')->on('TBL_Calidadpcs_Usuarios')->onDelete("cascade");

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
        Schema::dropIfExists('TBL_Calidadpcs_proyectos');
    }
}
