<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgregarCampoProyectoEstado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('TBL_Proyecto', function (Blueprint $table) {
            $table->integer('NPRY_Pro_Estado')->nullable()->after('FK_EST_Id');
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
            $table->dropcolumn('NPRY_Pro_Estado');
          });
    }
}
