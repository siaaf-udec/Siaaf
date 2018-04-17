<?php

namespace App\Container\Financial\src;


use App\Container\Financial\src\Constants\SchemaConstant;
use App\Container\Users\Src\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Program extends Model
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
    protected $table = SchemaConstant::PROGRAM;

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
    protected $fillable = [ SchemaConstant::PROGRAM_NAME ];

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
     * Mutator Attributes
     * ---------------------------------------------------------
     */

    /**
     * The attribute mutator to set string to upper
     *
     * @param $string
     */
    public function setProgramNameAttribute($string)
    {
        $this->attributes[ program_name() ] = toUpper( $string );
    }


    /*
     * ---------------------------------------------------------
     * Relations
     * ---------------------------------------------------------
     */

    public function teacher()
    {
        $table = SchemaConstant::getRelationNameTable( SchemaConstant::SUBJECT_PROGRAM );

        return $this->belongsToMany(User::class, $table, SchemaConstant::SUBJECT_FOREIGN_KEY, SchemaConstant::TEACHER_FOREIGN_KEY)
            ->withPivot(SchemaConstant::SUBJECT_FOREIGN_KEY, SchemaConstant::PROGRAM_FOREIGN_KEY);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, SchemaConstant::SUBJECT_PROGRAM, SchemaConstant::PROGRAM_FOREIGN_KEY, SchemaConstant::SUBJECT_FOREIGN_KEY)
            ->withPivot(SchemaConstant::PROGRAM_FOREIGN_KEY, SchemaConstant::TEACHER_FOREIGN_KEY);
    }
}