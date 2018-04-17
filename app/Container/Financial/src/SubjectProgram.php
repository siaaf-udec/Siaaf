<?php

namespace App\Container\Financial\src;


use App\Container\Financial\src\Constants\SchemaConstant;
use App\Container\Users\Src\User;
use Illuminate\Database\Eloquent\Model;

class SubjectProgram extends Model
{
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
    protected $table = SchemaConstant::SUBJECT_PROGRAM;

    /**
     * primaryKey
     *
     * @var integer
     * @access protected
     */
    protected $primaryKey = null;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        SchemaConstant::SUBJECT_FOREIGN_KEY,
        SchemaConstant::PROGRAM_FOREIGN_KEY,
        SchemaConstant::TEACHER_FOREIGN_KEY,
    ];

    public function teachers()
    {
        return $this->hasMany(User::class, 'id', SchemaConstant::TEACHER_FOREIGN_KEY);
    }

    public function programs()
    {
        return $this->hasMany(Program::class, SchemaConstant::PRIMARY_KEY, SchemaConstant::PROGRAM_FOREIGN_KEY);
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class, SchemaConstant::PRIMARY_KEY, SchemaConstant::SUBJECT_FOREIGN_KEY);
    }
}