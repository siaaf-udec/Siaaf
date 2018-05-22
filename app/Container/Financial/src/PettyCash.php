<?php

namespace App\Container\Financial\src;


use App\Container\Financial\src\Constants\SchemaConstant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class PettyCash extends Model
{
    const OUT   =   3;
    const IN    =   4;

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
    protected $table = SchemaConstant::PETTY_CASH;

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
        SchemaConstant::CONCEPT,
        SchemaConstant::COST,
        SchemaConstant::STATUS,
        SchemaConstant::SUPPORT,
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['status_name', 'pdf_url', 'cost_to_money'];

    /*
     * ---------------------------------------------------------
     * Accessors and Mutator Attributes
     * ---------------------------------------------------------
     */

    /**
     * The attribute to set number to format money
     *
     * @return string
     */
    public function getCostToMoneyAttribute()
    {
        return ( isset( $this->{ cost() } ) ) ? toMoney($this->{ cost() }) : toMoney(0);
    }

    /**
     * Get a pdf url from the storage
     *
     * @return null
     */
    public function getPdfUrlAttribute()
    {
        return isset( $this->{ support() } ) ? Storage::disk('financial')->url( $this->{ support() } ) : null;
    }

    /**
     * The attribute mutator to set string to upper
     *
     * @param $string
     */
    public function setConceptAttribute($string)
    {
        $this->attributes[ concept() ] = toUpper( $string );
    }

    /**
     * The attribute to set the name of status
     *
     * @return string
     */
    public function getStatusNameAttribute()
    {
        return ( isset( $this->{ status() } ) && $this->{ status() } === PettyCash::IN ) ? toUpper( __('validation.attributes.in') ) : toUpper( __('validation.attributes.out') );
    }

    /**
     * The attribute mutator to get a class name
     * useful to labels or buttons classes
     *
     * @return string
     */
    public function getClassNameAttribute()
    {
        return htmlClasses( $this->{ status() } );
    }

    /**
     * The attribute to get a html label
     * whit specified class
     *
     * @return string
     * @throws \Throwable
     */
    public function getStatusLabelAttribute()
    {
        $text = ( isset( $this->{ 'status_name' } ) ) ? $this->{ 'status_name' } : '';
        $type = ( isset( $this->class_name ) ) ? $this->class_name : 'default';
        return labelHtml( $type, $text );
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeSumIn($query)
    {
        return $query->where( status(), PettyCash::IN )->sum( cost() );
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeSumOut($query)
    {
        return $query->where( status(), PettyCash::OUT )->sum( cost() );
    }
}