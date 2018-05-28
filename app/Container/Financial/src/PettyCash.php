<?php

namespace App\Container\Financial\src;


use App\Container\Financial\src\Constants\SchemaConstant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as Auditor;

class PettyCash extends Model implements Auditable
{
    const OUT   =   3;
    const IN    =   4;

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
     * Attributes to include in the Audit.
     *
     * @var array
     */
    protected $auditInclude = [
        SchemaConstant::CONCEPT,
        SchemaConstant::COST,
        SchemaConstant::STATUS,
        SchemaConstant::SUPPORT,
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [ SchemaConstant::DELETED_AT ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['status_name', 'pdf_url', 'cost_to_money'];

    /*
     * ---------------------------------------------------------
     * Audit functions
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
            $data['new_values'][ status() ] = ($data['new_values'][ status() ] == PettyCash::IN) ? toUpper( __('validation.attributes.in') ) : toUpper( __('validation.attributes.out') );
        }
        if (Arr::has($data, 'old_values.'.status())) {
            $data['old_values'][ status() ] = ($data['old_values'][ status() ] == PettyCash::IN) ? toUpper( __('validation.attributes.in') ) : toUpper( __('validation.attributes.out') );
        }
        if (Arr::has($data, 'new_values'.support())) {
            $data['new_values'][ support() ] = isset( $data['new_values'][ support() ] ) && Storage::disk('financial')->exists( $data['new_values'][ support() ] ) ?
                Storage::disk('financial')->url( $data['new_values'][ support() ] ) : null;
        }
        if (Arr::has($data, 'old_values'.support())) {
            $data['old_values'][ support() ] = isset( $data['old_values'][ support() ] ) && Storage::disk('financial')->exists( $data['old_values'][ support() ] ) ?
                Storage::disk('financial')->url( $data['old_values'][ support() ] ) : null;
        }
        return $data;
    }

    /**
     * Generating tags for each model.
     *
     * @return array
     */
    public function generateTags() : array
    {
        return ['financial_petty_cash'];
    }

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
        $text = ( isset($this->{ deleted_at() }) ) ? 'Eliminado' : $text;
        $type = ( isset($this->{ deleted_at() }) ) ? 'default' : $type;
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