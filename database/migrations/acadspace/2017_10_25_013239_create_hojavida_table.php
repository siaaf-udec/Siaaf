<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHojaVidaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('acadspace')->create('TBL_Hojavida', function (Blueprint $table) {
            $table->increments('PK_HOJ_Id_Hojavida')->unsigned()->unique();
            $table->string('HOJ_Modelo_Equipo',150)->nullable();
            $table->string('HOJ_Procesador',80)->nullable();
            $table->string('HOJ_Memoria_Ram',15)->nullable();
            $table->string('HOJ_Disco_Duro',15)->nullable();
            $table->string('HOJ_Mouse',25)->nullable();
            $table->string('HOJ_Teclado',25)->nullable();
            $table->string('HOJ_Sistema_Operativo',50)->nullable();
            $table->string('HOJ_Antivirus',50)->nullable();
            $table->boolean('HOJ_Garantia')->nullable();
            $table->integer('FK_HOJ_Id_Marca')->unsigned();
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
        Schema::dropIfExists('TBL_Hojavida');
    }
}