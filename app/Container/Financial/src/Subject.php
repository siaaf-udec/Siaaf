<?php

namespace App\Container\Financial\src;


use App\Container\Financial\src\Constants\SchemaConstant;
use App\Container\Financial\src\Helpers\StringFormatter;
use App\Container\Users\Src\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Crypt;

class Subject extends Model
{
    use SoftDeletes;

    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = SchemaConstant::CONNECTION;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = SchemaConstant::SUBJECTS;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = SchemaConstant::PRIMARY_KEY;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        SchemaConstant::SUBJECT_CODE,
        SchemaConstant::SUBJECT_NAME,
        SchemaConstant::SUBJECT_CREDITS,
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [ SchemaConstant::DELETED_AT ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [SchemaConstant::CREATED_AT, SchemaConstant::UPDATED_AT, SchemaConstant::DELETED_AT];

    /*
     * ---------------------------------------------------------
     * Accessors and Mutator Attributes
     * ---------------------------------------------------------
     */

    /**
     * The attribute mutator to set string to upper
     *
     * @param $string
     */
    public function setSubjectNameAttribute($string)
    {
        $this->attributes[ subject_name() ] = toUpper( $string );
    }

    /**
     * The attribute mutator to set string to upper
     *
     * @param $string
     */
    public function setSubjectCodeAttribute($string)
    {
        $this->attributes[ subject_code() ] = toUpper( $string );
    }


    /*
     * ---------------------------------------------------------------------------------------
     * Models Relation
     * ---------------------------------------------------------------------------------------
     */

    public function teachers()
    {
        $table = SchemaConstant::getRelationNameTable( SchemaConstant::SUBJECT_PROGRAM );

        return $this->belongsToMany(User::class,
                                    $table,
                                    SchemaConstant::SUBJECT_FOREIGN_KEY,
                                    SchemaConstant::TEACHER_FOREIGN_KEY)
                    ->withPivot(SchemaConstant::SUBJECT_FOREIGN_KEY, SchemaConstant::PROGRAM_FOREIGN_KEY);
    }

    public function programs()
    {
        return $this->belongsToMany(Program::class,
                                    SchemaConstant::SUBJECT_PROGRAM,
                                    SchemaConstant::SUBJECT_FOREIGN_KEY,
                                    SchemaConstant::PROGRAM_FOREIGN_KEY)
                    ->withPivot(SchemaConstant::SUBJECT_FOREIGN_KEY, SchemaConstant::TEACHER_FOREIGN_KEY);
    }

    public function extensions()
    {
        return $this->belongsTo(Extension::class,
                                SchemaConstant::SUBJECT_FOREIGN_KEY,
                                SchemaConstant::PRIMARY_KEY);
    }
}