<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgregarCampoJurado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('TBL_Jurados', function (Blueprint $table) {
            $table->string('JR_Comentario_2',4000)->nullable()->after('JR_Comentario');
            $table->string('JR_Comentario_Proyecto_2',4000)->nullable()->after('JR_Comentario_Proyecto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('TBL_Jurados', function (Blueprint $table) {
            $table->string('JR_Comentario_2');
            $table->string('JR_Comentario_Proyecto_2');
          });
    }
}
