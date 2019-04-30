<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMctr008 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('gesap')->create('TBL_Mctr008', function (Blueprint $table) {
            $table->increments('PK_MCT_IdMctr008');
            $table->String('MCT_Actividad', 150);
            $table->String('MCT_Descripcion', 1500);
            $table->integer('FK_Id_Formato')->unsigned();
            $table->foreign('FK_Id_Formato')
                    ->references('PK_Id_Formato')
                    ->on('TBL_MCT_Formato')
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
        Schema::dropIfExists('TBL_Mctr008');
    }
}
