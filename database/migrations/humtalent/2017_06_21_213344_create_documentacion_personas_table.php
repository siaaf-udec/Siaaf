<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentacionPersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('humtalent')->create('TBL_Documentacion_Personal', function (Blueprint $table) {
            $table->increments('PK_DCMTP_Id_Documento')->unique();
            $table->String('DCMTP_Nombre_Documento', 50);
            $table->String('DCMTP_Tipo_Documento', 30);
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
        Schema::dropIfExists('TBL_Documentacion_Personal');
    }
}
