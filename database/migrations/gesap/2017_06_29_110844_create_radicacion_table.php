<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRadicacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {          
        Schema::connection('gesap')->create('TBL_Radicacion', function (Blueprint $table) {
            $table->increments('PK_RDCN_idRadicacion');
            $table->string('RDCN_Min',90);
            $table->String('RDCN_Requerimientos',90);

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
