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
        Schema::connection('gesap')->create('tbl_Encargados', function (Blueprint $table) {
            $table->increments('PK_NCRD_idCargo');
            
            $table->integer('FK_TBL_Anteproyecto_id')->unsigned();
            $table->foreign('FK_TBL_Anteproyecto_id')->references('PK_NPRY_idMinr008')->on('TBL_Anteproyecto')->onDelete('cascade');
            
            $table->integer('FK_developer_user_id')->unsigned();
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
        Schema::dropIfExists('TBL_Encargados');
    }
}
