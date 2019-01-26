<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('gesap')->create('TBL_commits', function (Blueprint $table) {
            $table->increments('PK_Id_Commit');
            $table->Integer('FK_NPRY_IdMctr008')->unsigned();
            $table->foreign('FK_NPRY_IdMctr008')
                  ->references('PK_NPRY_IdMctr008')
                  ->on('TBL_Anteproyecto')
                  ->onDelete('cascade');
            $table->Integer('FK_CTVD_IdActividad')->unsigned();
            $table->foreign('FK_CTVD_IdActividad')
                  ->references('PK_CTVD_IdActividad')
                  ->on('TBL_Actividades')
                  ->onDelete('cascade');
            $table->BigInteger('FK_User_Codigo')->unsigned();
            $table->foreign('FK_User_Codigo')
                        ->references('PK_User_Codigo')
                        ->on('TBL_Usuario')
                        ->onDelete('cascade');
            $table->String('CMMT_Commit', 500);
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
        Schema::dropIfExists('TBL_commits');
    }
}
