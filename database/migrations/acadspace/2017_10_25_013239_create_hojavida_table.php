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
        Schema::connection('acadspace')->create('tbl_hojavida', function (Blueprint $table) {
            $table->increments('pk_id_hojavida')->unsigned()->unique();
            $table->string('modelo_equipo',150)->nullable();
            $table->string('procesador',80)->nullable();
            $table->string('memoria_ram',15)->nullable();
            $table->string('disco_duro',15)->nullable();
            $table->string('mouse',25)->nullable();
            $table->string('teclado',25)->nullable();
            $table->string('sistema_operativo',50)->nullable();
            $table->string('antivirus',50)->nullable();
            $table->boolean('garantia')->nullable();
            $table->integer('fk_id_marca_equipo')->unsigned();
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
        Schema::dropIfExists('tbl_hojavida');
    }
}