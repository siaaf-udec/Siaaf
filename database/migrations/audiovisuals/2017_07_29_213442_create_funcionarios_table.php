<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuncionariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('audiovisuals')->create('TBL_Funcionarios', function (Blueprint $table) {
            $table->integer('PK_FUNCIONARIO_Cedula')->unsigned()->unique()->primary();
            $table->String('FUNCIONARIO_Clave', 40);
            $table->String('FK_FUNCIONARIO_Rol', 90);
            $table->String('FUNCIONARIO_Nombres', 90);
            $table->String('FUNCIONARIO_Apellidos', 90);
            $table->String('FUNCIONARIO_Direccion', 45);
            $table->String('FUNCIONARIO_Correo', 60);
            $table->String('FUNCIONARIO_Telefono', 90);
            $table->String('FK_FUNCIONARIO_Estado', 35)->nullable();
            $table->integer('FK_FUNCIONARIO_Programa')->unsigned();

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::connection('audiovisuals')->table('TBL_Funcionarios', function ($table) {

            $table->foreign('FK_FUNCIONARIO_Programa')->references('id')->on('carreras');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TBL_Funcionarios');
    }
}
