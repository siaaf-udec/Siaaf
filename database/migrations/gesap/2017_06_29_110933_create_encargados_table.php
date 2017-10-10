<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEncargadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('gesap')->create('TBL_Encargados', function (Blueprint $table) {
            $table->increments('PK_NCRD_IdCargo');
            
            $table->integer('FK_TBL_Anteproyecto_Id')->unsigned();
            $table->foreign('FK_TBL_Anteproyecto_Id')->references('PK_NPRY_IdMinr008')->on('TBL_Anteproyecto')->onDelete('cascade');
            
            $table->integer('FK_Developer_User_Id')->unsigned();
            $table->string('NCRD_Cargo',90);
            
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
        Schema::dropIfExists('TBL_Encargados');
    }
}
