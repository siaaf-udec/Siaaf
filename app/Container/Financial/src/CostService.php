<?php

namespace App\Container\Financial\src;

use App\Container\Financial\src\Constants\SchemaConstant;
use App\Container\Financial\src\Helpers\StringFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CostService extends Model
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
    protected $table = SchemaConstant::COST_SERVICES;

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
        SchemaConstant::COST,
        SchemaConstant::COST_SERVICE_NAME,
        SchemaConstant::COST_VALID_UNTIL,
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [ SchemaConstant::DELETED_AT, SchemaConstant::COST_VALID_UNTIL ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [SchemaConstant::CREATED_AT, SchemaConstant::UPDATED_AT, SchemaConstant::DELETED_AT];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['cost_to_money'];

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
    public function setCostServiceNameAttribute($string)
    {
        $this->attributes[ cost_service_name() ] = toUpper( $string );
    }

    /**
     * The attribute to set number to format money
     *
     * @return string
     */
    public function getCostToMoneyAttribute()
    {
        return ( isset( $this->{ cost() } ) ) ? toMoney($this->{ cost() }) : toMoney(0);
    }


    /*
    * ---------------------------------------------------------
    * Scopes
    * ---------------------------------------------------------
    */

    public function scopeCurrentCost( $query )
    {
        if ( isFirstSemester( today()->month ) ) {
            $query = $query->whereMonth( cost_valid_until(), '<=', 6 );
        } else {
            $query = $query->whereMonth( cost_valid_until(), '>=', 7 );
        }

        return $query->where( cost_valid_until(), '>', today() )->whereYear( cost_valid_until(), today()->year );
    }
}