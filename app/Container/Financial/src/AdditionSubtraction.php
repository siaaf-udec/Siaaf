<?php

namespace App\Container\Financial\src;

use App\Container\Financial\src\Constants\SchemaConstant;
use App\Container\Users\Src\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdditionSubtraction extends Model
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
    protected $table = SchemaConstant::ADD_SUB_SUBJECTS;

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
        SchemaConstant::ACTION_SUBJECT,
        SchemaConstant::APPROVAL_DATE,
        SchemaConstant::SUBJECT_FOREIGN_KEY,
        SchemaConstant::STUDENT_FOREIGN_KEY,
        SchemaConstant::STATUS_FOREIGN_KEY,
        SchemaConstant::COST_FOREIGN_KEY,
        SchemaConstant::APPROVED_BY,
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [ SchemaConstant::DELETED_AT, SchemaConstant::APPROVAL_DATE ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [SchemaConstant::DELETED_AT];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['total_cost'];

    /*
     * ---------------------------------------------------------
     * Accessors and Mutator Attributes
     * ---------------------------------------------------------
     */

    /**
     * The attribute to calculate the total cost of a service
     *
     * @return int/float
     */
    public function getTotalCostAttribute()
    {
        $credits = ( isset( $this->subject->{ subject_credits() } ) &&
                     is_int( $this->subject->{ subject_credits() } ) ) ?
                     (int) $this->subject->{ subject_credits() } : (int) 0;
        $cost    = ( isset( $this->cost->{ cost() } ) &&
                     is_float( $this->cost->{cost()} ) ) ?
                     (float) $this->cost->{ cost() } : (float) 0;
        return  (int) $credits * (float) $cost;
    }

    /**
     * The attribute to set number to format money
     *
     * @return mixed
     */
    public function getTotalCostToMoneyAttribute()
    {
        return ( isset($this->total_cost) ) ? toMoney($this->total_cost) : toMoney(0);
    }

    /*
     * ---------------------------------------------------------------------------------------
     * Models Relation
     * ---------------------------------------------------------------------------------------
     */

    public function subject()
    {
        return $this->hasOne(Subject::class,
                             SchemaConstant::PRIMARY_KEY,
                             SchemaConstant::SUBJECT_FOREIGN_KEY);
    }

    public function student()
    {
        return $this->hasOne(User::class,
                             'id',
                             SchemaConstant::STUDENT_FOREIGN_KEY );
    }

    public function secretary()
    {
        return $this->hasOne(User::class,
                             'id',
                             SchemaConstant::APPROVED_BY );
    }

    public function status()
    {
        return $this->hasOne(StatusRequest::class,
                             SchemaConstant::PRIMARY_KEY,
                             SchemaConstant::STATUS_FOREIGN_KEY);
    }

    public function cost()
    {
        return $this->hasOne(CostService::class,
                             SchemaConstant::PRIMARY_KEY,
                             SchemaConstant::COST_FOREIGN_KEY);
    }

    /**
     * Get all of the extensions's comments.
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}