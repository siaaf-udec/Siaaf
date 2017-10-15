<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSofwareTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('acadspace')->create('TBL_Software', function (Blueprint $table) {
            $table->increments('PK_SOF_Id')->unsigned()->unique();
            $table->string('SOF_Nombre_Soft',30);
            $table->string('SOF_Version',10);
            $table->integer('SOF_Licencias')->unsigned();
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
        Schema::dropIfExists('TBL_Software');
    }
}
