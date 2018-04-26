<?php

namespace App\Container\Financial\src;


use App\Container\Financial\src\Constants\SchemaConstant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Check extends Model
{

    const UNDELIVERED   =   1;
    const DELIVERED     =   2;

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
    protected $table = SchemaConstant::CHECKS;

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
        SchemaConstant::CHECK,
        SchemaConstant::PAY_TO,
        SchemaConstant::STATUS,
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['status_name'];

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
    public function setPayToAttribute($string)
    {
        $this->attributes[ pay_to() ] = toUpper( $string );
    }

    /**
     * The attribute to set the name of status
     *
     * @return string
     */
    public function getStatusNameAttribute()
    {
        return ( isset( $this->{ status() } ) && $this->{ status() } == Check::DELIVERED ) ? toUpper( __('validation.attributes.delivered') ) : toUpper( __('validation.attributes.undelivered') );
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
        $text = ( isset( $this->{ status_name() } ) ) ?
            $this->{ status_name() } : '';
        $type = ( isset( $this->class_name ) ) ?
            $this->class_name : 'default';
        return labelHtml( $type, $text );
    }
}