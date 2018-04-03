<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncidentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('acadspace')->create('TBL_Incidentes', function (Blueprint $table) {
            $table->increments('PK_INC_Id_Incidente')->unique();
            $table->integer('FK_INC_Id_User')->unsigned();
            $table->integer('FK_INC_Id_Espacio')->unsigned();
            $table->integer('fk_id_articulo')->unsigned();
            $table->string('INC_Descripcion',255);
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
        Schema::dropIfExists('TBL_Incidentes');
    }
}
