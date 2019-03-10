<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRadicacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('gesap')->create('TBL_Radicacion', function (Blueprint $table) {
            $table->increments('PK_RDCN_IdRadicacion');
            $table->String('RDCN_Mct', 90);
            $table->String('RDCN_Requerimientos', 90);
            $table->integer('FK_TBL_Anteproyecto_Id')->unsigned();
            $table->foreign('FK_TBL_Anteproyecto_Id')
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
        Schema::dropIfExists('TBL_Radicacion');
    }
}
