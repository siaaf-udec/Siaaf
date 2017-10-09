<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTBLTipoUsuarioTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::connection('unvinteraction')->create('TBL_Tipo_Usuario', function (Blueprint $table) {
            
            $table->increments('PK_Tipo_Usuario');
            $table->string('Descripcion',120);          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
