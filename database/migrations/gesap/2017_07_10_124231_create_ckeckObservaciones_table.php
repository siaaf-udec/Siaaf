<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCkeckObservacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('gesap')->create('tbl_check_observaciones', function (Blueprint $table) {
            $table->increments('PK_CBSV_id');
            $table->boolean('CBSV_Estudiante1')->default(0);
            $table->boolean('CBSV_Estudiante2')->default(0);
            $table->boolean('CBSV_Director')->default(0);
            $table->integer('FK_TBL_Observaciones_id')->unsigned();
            $table->foreign('FK_TBL_Observaciones_id')->references('PK_BVCS_idObservacion')->on('tbl_observaciones')->onDelete('cascade');
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
        Schema::dropIfExists('tbl_check_observaciones');
    }
}
