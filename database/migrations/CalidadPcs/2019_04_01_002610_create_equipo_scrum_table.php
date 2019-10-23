<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipoScrumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('calidadpcs')->create('TBL_Calidadpcs_equipo_scrum', function (Blueprint $table) {
            $table->increments('PK_CE_Id_Equipo_Scrum');
            $table->String('CE_Nombre_Persona')->nullable();
            $table->String('CE_Horas_Trabajadas')->nullable();
            $table->integer('CE_Estado')->default(0);
            $table->integer('FK_CE_Id_Rol')->unsigned();
            $table->foreign('FK_CE_Id_Rol')->references('PK_CR_Id_Rol_Scrum')->on('TBL_Calidadpcs_rol_scrum')->onDelete("cascade");
            $table->integer('FK_CE_Id_Proyecto')->unsigned();
            $table->foreign('FK_CE_Id_Proyecto')->references('PK_CP_Id_Proyecto')->on('TBL_Calidadpcs_proyectos')->onDelete("cascade");

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
        Schema::dropIfExists('TBL_Calidadpcs_equipo_scrum');
    }
}
