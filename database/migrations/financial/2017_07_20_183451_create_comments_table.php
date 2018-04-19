<?php

use App\Container\Financial\src\Constants\SchemaConstant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(SchemaConstant::CONNECTION )->create(SchemaConstant::COMMENTS, function (Blueprint $table) {
            $table->increments(SchemaConstant::PRIMARY_KEY)
                    ->comment('Campo que contiene el identificador del registro.');
            $table->text(SchemaConstant::COMMENT)
                    ->comment('Campo que contiene el texto del comentario realizado.');
            $table->unsignedBigInteger( SchemaConstant::USER_FOREIGN_KEY )
                    ->comment('Campo que identifica al usuario que realiza el comentario.');
            $table->unsignedInteger( SchemaConstant::COMMENTABLE_ID )
                    ->comment('Campo que contiene el identificador de la solicitud a la que pertenece el comentario.');
            $table->string( SchemaConstant::COMMENTABLE_TYPE )
                    ->comment('Canpo que contiene el nombre de la clase o modelo propietario.');
            $table->timestamps();
            $table->softDeletes();
        });

        SchemaConstant::commentTable(
            SchemaConstant::COMMENTS,
            'Tabla que contiene los comentarios realizados a las solicitudes.',
            true);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(SchemaConstant::COMMENTS);
    }
}
