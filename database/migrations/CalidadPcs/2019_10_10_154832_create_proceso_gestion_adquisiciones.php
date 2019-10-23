<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcesoGestionAdquisiciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('calidadpcs')->create('TBL_Calidadpcs_proceso_adquisiciones', function (Blueprint $table) {
            $table->increments('PK_CPGA_Id_Adquisicion');
            $table->string('CPGA_Adquisicion');
            $table->double('CPGA_Costo',12,2);
            $table->string('CPGA_Duracion');
            $table->string('CPGA_Proveedor')->nullable();
            $table->string('CPGA_Tipo_Contrato')->nullable();
            $table->integer('CPGA_Estado')->default(0);
            $table->integer('FK_CPC_Id_Proyecto')->unsigned();
            $table->foreign('FK_CPC_Id_Proyecto')->references('PK_CP_Id_Proyecto')->on('TBL_Calidadpcs_proyectos')->onDelete("cascade");
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
        Schema::dropIfExists('TBL_Calidadpcs_proceso_adquisiciones');
    }
}
