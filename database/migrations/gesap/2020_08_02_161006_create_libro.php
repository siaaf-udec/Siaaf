<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLibro extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('gesap')->create('TBL_Libro', function (Blueprint $table) {
            $table->increments('PK_PYT_Libro');
            $table->String('PYT_Actividad', 50);
            $table->String('PYT_Descripcion', 500);
            /*
            $table->integer('FK_Id_Formato')->unsigned();
            $table->foreign('FK_Id_Formato')
                    ->references('PK_Id_Formato')
                    ->on('TBL_MCT_Formato')
                    ->onDelete('cascade');
            

            $table->timestamps();
     */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TBL_Libro');
    }
}
