<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetallesPersona extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('gesap')->create('TBL_MCT_Detalles_Persona', function (Blueprint $table) {
            $table->increments('PK_Id_Dpersona');
            $table->String('MCT_Detalles_Entidad');
            $table->String('MCT_Detalles_Primer_Apellido');
            $table->String('MCT_Detalles_Segundo_Apellido');
            $table->String('MCT_Detalles_Nombres');
            $table->String('MCT_Detalles_Genero');
            $table->date('MCT_Detalles_Fecha_Nacimiento');
            $table->String('MCT_Detalles_Pais');
            $table->String('MCT_Detalles_Correo');
            $table->String('MCT_Detalles_Tipo_Doc');
            $table->String('MCT_Detalles_Numero');
            $table->String('MCT_Detalles_Funcion');
            $table->String('MCT_Detalles_Horas_Semanales');
            $table->String('MCT_Detalles_Numero_Meses');
            $table->String('MCT_Detalles_Tipo_Vinculacion');
            $table->Integer('FK_NPRY_IdMctr008')->unsigned();
            $table->foreign('FK_NPRY_IdMctr008')
                  ->references('PK_NPRY_IdMctr008')
                  ->on('TBL_Anteproyecto')
                  ->onDelete('cascade');
           
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
        Schema::dropIfExists('TBL_MCT_Detalles_Persona');
    }
}
