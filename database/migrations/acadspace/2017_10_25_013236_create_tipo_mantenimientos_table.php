<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatetipoMantenimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('acadspace')->create('TBL_Tipo_Mantenimientos', function (Blueprint $table) {
            $table->increments('PK_MAN_Id_Tipo')->unsigned()->unique();
            $table->string('MAN_Nombre',50);
            $table->string('MAN_Descripcion',450);                        
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
        Schema::dropIfExists('TBL_Tipo_Mantenimientos');
    }
}