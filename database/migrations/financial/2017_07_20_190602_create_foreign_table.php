<?php

use App\Container\Financial\src\Constants\SchemaConstant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignTable extends Migration
{
    /**
     * Run the migrations to make foreign keys for all tables.
     *
     * @return void
     */
    public function up()
    {
        SchemaConstant::commentTable(
            'migrations',
            'Tabla que contiene el registro de las migraciones realizadas por consola.');

        $schema = Schema::connection(SchemaConstant::CONNECTION);

        $schema->table(SchemaConstant::INTERSEMESTRAL_STUDENT, function (Blueprint $table) {
            $table->foreign(SchemaConstant::INTERSEMESTRAL_FOREIGN_KEY)
                ->references(SchemaConstant::PRIMARY_KEY)
                ->on(SchemaConstant::INTERSEMESTRAL)
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        $schema->table(SchemaConstant::INTERSEMESTRAL, function (Blueprint $table) {
            $table->foreign(SchemaConstant::SUBJECT_FOREIGN_KEY)
                ->references(SchemaConstant::SUBJECT_FOREIGN_KEY)
                ->on(SchemaConstant::SUBJECT_PROGRAM)
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign(SchemaConstant::COST_FOREIGN_KEY)
                ->references(SchemaConstant::PRIMARY_KEY)
                ->on(SchemaConstant::COST_SERVICES)
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        $schema->table(SchemaConstant::EXTENSION, function (Blueprint $table) {
            $table->foreign(SchemaConstant::SUBJECT_FOREIGN_KEY)
                ->references(SchemaConstant::SUBJECT_FOREIGN_KEY)
                ->on(SchemaConstant::SUBJECT_PROGRAM)
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign(SchemaConstant::STATUS_FOREIGN_KEY)
                ->references(SchemaConstant::PRIMARY_KEY)
                ->on(SchemaConstant::REQUEST_STATUS)
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign(SchemaConstant::COST_FOREIGN_KEY)
                ->references(SchemaConstant::PRIMARY_KEY)
                ->on(SchemaConstant::COST_SERVICES)
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        $schema->table(SchemaConstant::ADD_SUB_SUBJECTS, function (Blueprint $table) {
            $table->foreign(SchemaConstant::SUBJECT_FOREIGN_KEY)
                ->references(SchemaConstant::SUBJECT_FOREIGN_KEY)
                ->on(SchemaConstant::SUBJECT_PROGRAM)
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign(SchemaConstant::STATUS_FOREIGN_KEY)
                ->references(SchemaConstant::PRIMARY_KEY)
                ->on(SchemaConstant::REQUEST_STATUS)
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign(SchemaConstant::COST_FOREIGN_KEY)
                ->references(SchemaConstant::PRIMARY_KEY)
                ->on(SchemaConstant::COST_SERVICES)
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        $schema->table(SchemaConstant::VALIDATION, function (Blueprint $table) {
            $table->foreign(SchemaConstant::SUBJECT_FOREIGN_KEY)
                ->references(SchemaConstant::SUBJECT_FOREIGN_KEY)
                ->on(SchemaConstant::SUBJECT_PROGRAM)
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign(SchemaConstant::STATUS_FOREIGN_KEY)
                ->references(SchemaConstant::PRIMARY_KEY)
                ->on(SchemaConstant::REQUEST_STATUS)
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign(SchemaConstant::COST_FOREIGN_KEY)
                ->references(SchemaConstant::PRIMARY_KEY)
                ->on(SchemaConstant::COST_SERVICES)
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        $schema->table(SchemaConstant::FILES, function (Blueprint $table) {
            $table->foreign(SchemaConstant::FILE_TYPE_FOREIGN_KEY)
                ->references(SchemaConstant::PRIMARY_KEY)
                ->on(SchemaConstant::FILE_TYPE)
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        $schema->table(SchemaConstant::SUBJECT_PROGRAM, function (Blueprint $table) {
            $table->foreign(SchemaConstant::SUBJECT_FOREIGN_KEY)
                ->references(SchemaConstant::PRIMARY_KEY)
                ->on(SchemaConstant::SUBJECTS)
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign(SchemaConstant::PROGRAM_FOREIGN_KEY)
                ->references(SchemaConstant::PRIMARY_KEY)
                ->on(SchemaConstant::PROGRAM)
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $schema = Schema::connection(SchemaConstant::CONNECTION);

        $schema->table(SchemaConstant::INTERSEMESTRAL_STUDENT, function (Blueprint $table) {
            $table->dropForeign([SchemaConstant::INTERSEMESTRAL_FOREIGN_KEY]);
            $table->dropForeign([SchemaConstant::STATUS_FOREIGN_KEY]);
        });

        $schema->table(SchemaConstant::INTERSEMESTRAL, function (Blueprint $table) {
            $table->dropForeign([SchemaConstant::SUBJECT_FOREIGN_KEY]);
            $table->dropForeign([SchemaConstant::COST_FOREIGN_KEY]);
        });

        $schema->table(SchemaConstant::EXTENSION, function (Blueprint $table) {
            $table->dropForeign([SchemaConstant::SUBJECT_FOREIGN_KEY]);
            $table->dropForeign([SchemaConstant::STATUS_FOREIGN_KEY]);
            $table->dropForeign([SchemaConstant::COST_FOREIGN_KEY]);
        });

        $schema->table(SchemaConstant::ADD_SUB_SUBJECTS, function (Blueprint $table) {
            $table->dropForeign([SchemaConstant::SUBJECT_FOREIGN_KEY]);
            $table->dropForeign([SchemaConstant::STATUS_FOREIGN_KEY]);
            $table->dropForeign([SchemaConstant::COST_FOREIGN_KEY]);
        });

        $schema->table(SchemaConstant::VALIDATION, function (Blueprint $table) {
            $table->dropForeign([SchemaConstant::SUBJECT_FOREIGN_KEY]);
            $table->dropForeign([SchemaConstant::STATUS_FOREIGN_KEY]);
            $table->dropForeign([SchemaConstant::COST_FOREIGN_KEY]);
        });

        $schema->table(SchemaConstant::FILES, function (Blueprint $table) {
            $table->dropForeign([SchemaConstant::FILE_TYPE_FOREIGN_KEY]);
        });

        $schema->table(SchemaConstant::SUBJECT_PROGRAM, function (Blueprint $table) {
            $table->dropForeign([SchemaConstant::SUBJECT_FOREIGN_KEY]);
            $table->dropForeign([SchemaConstant::PROGRAM_FOREIGN_KEY]);
        });

        $schema->table(SchemaConstant::COMMENTS, function (Blueprint $table) {
            $table->dropForeign([SchemaConstant::EXTENSION_FOREIGN_KEY]);
        });
    }
}
