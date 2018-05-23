<?php

namespace App\Container\Financial\src;


use App\Container\Financial\src\Constants\SchemaConstant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as Auditor;

class Check extends Model implements Auditable
{

    const UNDELIVERED   =   1;
    const DELIVERED     =   2;

    use SoftDeletes, Auditor;

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
        SchemaConstant::DELIVERED_AT,
    ];

    /**
     * Attributes to include in the Audit.
     *
     * @var array
     */
    protected $auditInclude = [
        SchemaConstant::CHECK,
        SchemaConstant::PAY_TO,
        SchemaConstant::STATUS,
        SchemaConstant::DELIVERED_AT,
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [ SchemaConstant::DELETED_AT, SchemaConstant::DELIVERED_AT ];


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
     * Audit data can be transformed before being stored.
     *
     * @param array $data
     * @return array
     */
    public function transformAudit(array $data) : array
    {
        if (Arr::has($data, 'new_values.'.status())) {
            $data['new_values'][ status() ] = ($data['new_values'][ status() ] == Check::DELIVERED) ? toUpper( __('validation.attributes.delivered') ) : toUpper( __('validation.attributes.undelivered') );
        }
        if (Arr::has($data, 'old_values.'.status())) {
            $data['old_values'][ status() ] = ($data['old_values'][ status() ] == Check::DELIVERED) ? toUpper( __('validation.attributes.delivered') ) : toUpper( __('validation.attributes.undelivered') );
        }
        return $data;
    }

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
        $text = ( isset($this->{ deleted_at() }) ) ? 'Eliminado' : $text;
        $type = ( isset($this->{ deleted_at() }) ) ? 'default' : $type;
        return labelHtml( $type, $text );
    }
}