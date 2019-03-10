<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitud extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('gesap')->create('TBL_Solicitud', function (Blueprint $table) {
            $table->increments('Pk_Id_Solicitud');
            $table->String('Sol_Solicitud');
            $table->String('Sol_Estado',12);
            $table->Integer('FK_NPRY_IdMctr008')->unsigned();
            $table->foreign('FK_NPRY_IdMctr008')
                  ->references('PK_NPRY_IdMctr008')
                  ->on('TBL_Anteproyecto')
                  ->onDelete('cascade');
            $table->BigInteger('FK_User_Codigo')->unsigned();
            $table->foreign('FK_User_Codigo')
                        ->references('PK_User_Codigo')
                        ->on('TBL_Usuario')
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
        Schema::dropIfExists('TBL_Solicitud');
    }
}
