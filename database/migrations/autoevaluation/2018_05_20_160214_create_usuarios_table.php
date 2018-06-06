<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection("autoevaluation")->create('TBL_Usuarios', function (Blueprint $table) {
            $table->increments('PK_USU_id');
            $table->string("USU_Nombre");
            $table->string("USU_Apellido");
            $table->string("USU_Correo");
            $table->string("USU_Clave");
            $table->integer("FK_USU_Estado")->unsigned();
            $table->integer("FK_USU_rol")->unsigned();
            $table->timestamps();
            $table->rememberToken();

            $table->foreign("FK_USU_Estado")->references("PK_ESD_Id")->on("TBL_Estados")->onDelete("cascade");
            $table->foreign("FK_USU_rol")->references("PK_ROL_Id")->on("TBL_Roles")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TBL_Usuarios');
    }
}
