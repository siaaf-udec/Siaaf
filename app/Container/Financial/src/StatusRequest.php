<?php
/**
 * Created by PhpStorm.
 * User: danielprado
 * Date: 2/10/17
 * Time: 1:40 PM
 */

namespace App\Container\Financial\src;

use App\Container\Financial\src\Constants\ConstantLabelClasses;
use App\Container\Financial\src\Constants\SchemaConstant;
use App\Container\Financial\src\Helpers\StringFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StatusRequest extends Model
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
    protected $table = SchemaConstant::REQUEST_STATUS;

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
    protected $fillable = [ SchemaConstant::STATUS_NAME, SchemaConstant::STATUS_TYPE ];

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
    public function setStatusNameAttribute($string)
    {
        $this->attributes[ status_name() ] = toUpper( $string );
    }

    /**
     * The attribute mutator to set string to upper
     *
     * @param $string
     */
    public function setStatusTypeAttribute($string)
    {
        $this->attributes[ status_type() ] = toUpper( $string );
    }

    /**
     * The attribute mutator to get a class name
     * useful to labels or buttons classes
     *
     * @return string
     */
    public function getClassNameAttribute()
    {
        return htmlClasses( $this->{ status_name() } );
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

    /*
     * ---------------------------------------------------------
     * Relations
     * ---------------------------------------------------------
     */
}