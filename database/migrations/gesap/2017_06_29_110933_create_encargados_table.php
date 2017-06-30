<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEncargadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('gesap')->create('TBL_Encargados', function (Blueprint $table) {
            $table->increments('PK_NPRY_idCargo');
            $table->integer('FK_TBL_Anteproyecto_id')->unsigned();
            $table->foreign('FK_TBL_Anteproyecto_id')->references('PK_NPRY_idMinr008')->on('TBL_Anteproyecto');
            //$table->integer('FK_TBL_Usuarios_id')->unsigned();
            //$table->foreign('FK_TBL_Usuarios_id')->references('PK_USER_idUser')->on('TBL_Users');
            $table->string('NCRD_Usuario',90);
            $table->string('NCRD_Cargo',90);
            
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
        //
    }
}
