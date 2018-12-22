<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLibroGesap extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::connection('gesap')->create('TBL_Libro', function (Blueprint $table) {
            $table->increments('PK_Libro_Id');
            $table->String('LB_Informe_Investigacion', 100);
            $table->String('LB_Marcos', 100);
            $table->String('LB_Plan_Proyecto', 100);
            $table->String('LB_Requerimientos', 100);
            $table->String('LB_Modelados', 100);
            $table->String('LB_Pruebas_Calisoft', 100);
            $table->String('LB_Estimacion_Recursos', 100);
            $table->String('LB_Resultados', 100);
            $table->String('LB_Conclusiones', 100);
            $table->String('LB_Bibliografia', 100);
            $table->String('LB_Anexos', 100);
            $table->String('LB_Articulos', 100);
            $table->integer('FK_TBL_Actividad_Id')->unsigned();
            $table->foreign('FK_TBL_Actividad_Id')->references('PK_CTVD_IdActividad')->on('TBL_Actividades');
            $table->integer('FK_TBL_Proyecto_Id')->unsigned();
            $table->foreign('FK_TBL_Proyecto_Id')->references('PK_PRYT_IdProyecto')->on('TBL_Proyecto');

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
        Schema::dropIfExists('TBL_GESAP_Libro');
    }
}
