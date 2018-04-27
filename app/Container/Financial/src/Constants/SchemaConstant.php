<?php

namespace App\Container\Financial\src\Constants;


use Illuminate\Support\Facades\DB;

class SchemaConstant
{
    /*
     * Common Values
     */
    const TABLE_PREFIX              = 'tbl_';
    const PRIMARY_KEY               = 'pk_id';
    const FOREIGN_KEY               = '_fk';
    const DROP_FOREIGN              = '_fk_foreign';
    const CONNECTION                = 'financial';

    /*
     * Index table name
     */
    const PETTY_CASH                = 'petty_cash';
    const CHECKS                    = 'checks';
    const AVAILABLE_MODULES         = 'available_modules';
    const INTERSEMESTRAL_STUDENT    = 'intersemestral_students';
    const INTERSEMESTRAL            = 'intersemestrals';
    const EXTENSION                 = 'extensions';
    const ADD_SUB_SUBJECTS          = 'add_sub_subjects';
    const VALIDATION                = 'validations';
    const REQUEST_STATUS            = 'request_status';
    const COST_SERVICES             = 'cost_services';
    const PROGRAM                   = 'programs';
    const SUBJECTS                  = 'subjects';
    const FILES                     = 'files';
    const FILE_TYPE                 = 'file_types';
    const SUBJECT_PROGRAM           = 'subjects_programs';
    const COMMENTS                  = 'comments';

    /*
     * Common Foreign Keys
     */
    const STUDENT_FOREIGN_KEY               = 'student'         .self::FOREIGN_KEY;
    const TEACHER_FOREIGN_KEY               = 'teacher'         .self::FOREIGN_KEY;
    const USER_FOREIGN_KEY                  = 'user'            .self::FOREIGN_KEY;
    const COST_FOREIGN_KEY                  = 'cost_service'    .self::FOREIGN_KEY;
    const SUBJECT_FOREIGN_KEY               = 'subject'         .self::FOREIGN_KEY;
    const PROGRAM_FOREIGN_KEY               = 'program'         .self::FOREIGN_KEY;
    const STATUS_FOREIGN_KEY                = 'status'          .self::FOREIGN_KEY;
    const INTERSEMESTRAL_FOREIGN_KEY        = 'intersemestral'  .self::FOREIGN_KEY;
    const FILE_TYPE_FOREIGN_KEY             = 'file_type'       .self::FOREIGN_KEY;
    const EXTENSION_FOREIGN_KEY             = 'extension'       .self::FOREIGN_KEY;

    /*
     * Table Fields
     */
    const CONCEPT           = 'concept';
    const SUPPORT           = 'support';
    const STATUS            = 'status';
    const MODULE_NAME       = 'module_name';
    const AVAILABLE_FROM    = 'available_from';
    const AVAILABLE_UNTIL   = 'available_until';
    const CHECK             = 'check';
    const PAY_TO            = 'pay_to';
    const COST              = 'cost';
    const PAID              = 'paid';
    const COST_SERVICE_NAME = 'cost_service_name';
    const COST_VALID_UNTIL  = 'cost_valid_until';
    const STATUS_NAME       = 'status_name';
    const STATUS_TYPE       = 'status_type';
    const PROGRAM_NAME      = 'program_name';
    const APPROVAL_DATE     = 'approval_date';
    const APPROVED_BY       = 'approved_by';
    const REALIZATION_DATE  = 'realization_date';
    const ACTION_SUBJECT    = 'action_subject';
    const SUBJECT_CODE      = 'subject_code';
    const SUBJECT_NAME      = 'subject_name';
    const SUBJECT_CREDITS   = 'subject_credits';
    const COMMENT           = 'comment';
    const COMMENTABLE_ID    = 'commentable_id';
    const COMMENTABLE_TYPE  = 'commentable_type';
    const FILE_NAME         = 'file_name';
    const FILE_ROUTE        = 'file_route';
    const CREATED_AT        = 'created_at';
    const UPDATED_AT        = 'updated_at';
    const DELETED_AT        = 'deleted_at';
    const DELIVERED_AT      = 'delivered_at';

    /**
     * Retrieve full table name with connection name,
     * table prefix and table name, useful for
     * related tables on different databases
     *
     * @param $table
     * @return string
     */
    public static function getRelationNameTable( $table )
    {
        return self::CONNECTION.'.'.self::getTableFullName( $table );
    }

    /**
     * The method to generate a table name with a prefix
     *
     * @param $table
     * @return string
     * @internal param $key
     */
    public static function getTableFullName( $table )
    {
        return self::TABLE_PREFIX.$table;
    }

    /**
     * The method to add a comment to table in database
     *
     * @param $table
     * @param $comment
     * @param bool|null $timestamp
     */
    public static function commentTable( $table, $comment, $timestamp = false )
    {
        $table = self::getTableFullName( $table );
        $statement = DB::connection( self::CONNECTION );
        $statement->statement( "ALTER TABLE `$table` COMMENT '$comment'" );

        if ( $timestamp ) {
            $statement->statement("ALTER TABLE `$table` MODIFY COLUMN `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Campo que contiene la fecha de creación del registro.'");
            $statement->statement("ALTER TABLE `$table` MODIFY COLUMN `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Campo que contiene la fecha de actualización del registro.'");
            $statement->statement("ALTER TABLE `$table` MODIFY COLUMN `deleted_at` TIMESTAMP NULL DEFAULT NULL COMMENT 'Campo que contiene la fecha de eliminación del registro.'");
        }
    }
}