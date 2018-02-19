<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTBLDocumentacionExtraTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('unvinteraction')->create('TBL_Documentacion_Extra', function (Blueprint $table) {
            $table->increments('PK_DCET_Documentacion_Extra');
            $table->string('DCET_Ubicacion',120);
            $table->string('DCET_Nombre',120);
            $table->integer('FK_TBL_Usuarios_Id')->unsigned();
            $table->foreign('FK_TBL_Usuarios_Id')->references('PK_USER_Usuario')->on('TBL_Usuario');
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
