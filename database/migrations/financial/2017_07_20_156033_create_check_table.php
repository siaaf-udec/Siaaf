<?php

use App\Container\Financial\src\Constants\SchemaConstant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(SchemaConstant::CONNECTION )->create(SchemaConstant::CHECKS , function (Blueprint $table) {
            $table->increments(SchemaConstant::PRIMARY_KEY)
                    ->comment('Campo que contiene el identificador del registro.');
            $table->string( SchemaConstant::CHECK )
                    ->comment('Campo que contiene el número del cheque.');
            $table->text( SchemaConstant::PAY_TO )
                    ->comment('Campo que contiene el nombre de la persona a quien pertenece el cheque.');
            $table->unsignedTinyInteger( SchemaConstant::STATUS )
                    ->comment('Campo que contiene el estado del cheque si es entregado o no.');
            $table->dateTime( SchemaConstant::DELIVERED_AT )->nullable()
                    ->comment('Campo que contiene la fecha de entrega del cheque.');
            $table->timestamps();
            $table->softDeletes();
        });

        SchemaConstant::commentTable(
            SchemaConstant::CHECKS,
            'Tabla que contiene los cheques pendiente de entrega o entregados.',
            true);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(SchemaConstant::CHECKS );
    }
}
