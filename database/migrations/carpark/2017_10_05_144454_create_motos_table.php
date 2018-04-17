<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('carpark')->create('TBL_Carpark_Motos', function (Blueprint $table) {
            $table->integer('PK_CM_IdMoto')->unique()->primary();
            $table->String('CM_Placa', 6);
            $table->String('CM_Marca', 50);
            $table->String('CM_NuPropiedad', 20);
            $table->String('CM_NuSoat', 20);
            $table->date('CM_FechaSoat');
            $table->String('CM_UrlFoto', 100)->nullable();
            $table->String('CM_UrlPropiedad', 100)->nullable();
            $table->String('CM_UrlSoat', 100)->nullable();
            $table->String('FK_CM_CodigoUser');
            $table->foreign('FK_CM_CodigoUser')->references('number_document')->on('developer.users_udec');

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
        Schema::dropIfExists('TBL_Carpark_Motos');
    }
}
