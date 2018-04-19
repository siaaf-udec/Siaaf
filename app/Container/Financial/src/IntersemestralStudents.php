<?php

namespace App\Container\Financial\src;


use App\Container\Financial\src\Constants\SchemaConstant;
use App\Container\Users\Src\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IntersemestralStudents extends Model
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
    protected $table = SchemaConstant::INTERSEMESTRAL_STUDENT;

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
        SchemaConstant::PAID,
        SchemaConstant::INTERSEMESTRAL_FOREIGN_KEY,
        SchemaConstant::STUDENT_FOREIGN_KEY,
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
    protected $hidden = [ SchemaConstant::DELETED_AT ];

    /*
     * ---------------------------------------------------------
     * Accessors and Mutator Attributes
     * ---------------------------------------------------------
     */



    /*
     * ---------------------------------------------------------------------------------------
     * Models Relation
     * ---------------------------------------------------------------------------------------
     */

    /**
     * Get intersemestral relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subscribed()
    {
        return $this->belongsTo(Intersemestral::class,
            SchemaConstant::INTERSEMESTRAL_FOREIGN_KEY,
            SchemaConstant::PRIMARY_KEY);
    }

    /**
     * Get student relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function student()
    {
        return $this->hasOne(User::class,
            'id',
            SchemaConstant::STUDENT_FOREIGN_KEY );
    }

    /*
     * ---------------------------------------------------------
     * Scopes
     * ---------------------------------------------------------
     */

    /**
     * Get current subscribers in an intersemestral
     *
     * @param $query
     * @return mixed
     */
    public function scopeCurrentSubscribers( $query )
    {
        if ( isFirstSemester( today()->month ) ) {
            $query = $query->whereMonth( created_at(), '<=', 6 );
        } else {
            $query = $query->whereMonth( created_at(), '>=', 7 );
        }

        return $query->whereYear( created_at(), today()->year );
    }

    /**
     * Get student where paid an intersemestral
     *
     * @param $query
     * @return mixed
     */
    public function scopeWhereHasPaid($query )
    {
        return $query->where( paid(), true );
    }
}