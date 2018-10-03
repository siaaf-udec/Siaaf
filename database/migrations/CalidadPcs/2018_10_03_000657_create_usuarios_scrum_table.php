<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosScrumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('calidadpcs')->create('TBL_Calidadpcs_users_scrum', function (Blueprint $table) {
            $table->integer('PK_CU_Id_user_scrum')->unique()->primary();
            $table->String('CU_Id_rol_scrum');
            $table->String('CU_Id_proyecto');
            $table->String('CU_nombre_person');
            $table->datetime('CU_FHentrada');
            $table->timestamp('CU_FHsalida')->default(DB::raw('CURRENT_TIMESTAMP'));
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
        Schema::dropIfExists('TBL_Calidadpcs_users_scrum');
    }
}
