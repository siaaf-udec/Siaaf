<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlcancesAdministrativosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_Alcances_Administrativos', function (Blueprint $table) {
            $table->increments('PK_AAD_Id');
            $table->string("AAD_Alcance", 150);
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
        Schema::dropIfExists('TBL_Alcances_Administrativos');
    }
}
