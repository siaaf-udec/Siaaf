<?php

use App\Container\Financial\src\Constants\SchemaConstant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePettyCashTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(SchemaConstant::CONNECTION )->create(SchemaConstant::PETTY_CASH , function (Blueprint $table) {
            $table->increments(SchemaConstant::PRIMARY_KEY)
                    ->comment('Campo que contiene el identificador del registro.');
            $table->text( SchemaConstant::CONCEPT )
                ->comment('Campo que contiene el concepto de la transacción.');
            $table->double( SchemaConstant::COST, 12, 3 )
                    ->comment('Campo que contiene el monto total de la transacción.');
            $table->unsignedTinyInteger( SchemaConstant::STATUS )
                    ->comment('Campo que contiene el estado de la transacción si es entrada o salida de dinero.');
            $table->text( SchemaConstant::SUPPORT )->nullable()
                ->comment('Campo que contiene el soporte de la transacción.');
            $table->timestamps();
            $table->softDeletes();
        });

        SchemaConstant::commentTable(
            SchemaConstant::PETTY_CASH,
            'Tabla que contiene los movimientos de caja menor.',
            true);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(SchemaConstant::PETTY_CASH );
    }
}
