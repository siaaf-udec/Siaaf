<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAulasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('acadspace')->create('TBL_Aulas', function (Blueprint $table) {
            $table->increments('PK_SAL_Id_Sala')->unsigned()->unique();
            $table->string('SAL_Nombre_Sala',20);
            $table->string('SAL_Nombre_Espacio',50);
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
        Schema::dropIfExists('TBL_Aulas');
    }
}
