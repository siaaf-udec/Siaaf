<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgregarCampoProyecto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('TBL_Proyecto', function (Blueprint $table) {
            $table->bigInteger('FK_NPRY_Director')->unsigned()->nullable();
            $table->foreign('FK_NPRY_Director')
                ->references('PK_User_Codigo')
                ->on('TBL_Usuario')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('TBL_Proyecto', function (Blueprint $table) {
            $table->dropcolumn('FK_NPRY_Director');
          });
    }
}
