<?php

namespace App\Container\Financial\src;


use App\Container\Financial\src\Constants\SchemaConstant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AvailableModules extends Model
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
    protected $table = SchemaConstant::AVAILABLE_MODULES;

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
        SchemaConstant::MODULE_NAME,
        SchemaConstant::AVAILABLE_FROM,
        SchemaConstant::AVAILABLE_UNTIL,
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [ SchemaConstant::DELETED_AT, SchemaConstant::AVAILABLE_FROM, SchemaConstant::AVAILABLE_UNTIL ];

    /*
     * ---------------------------------------------------------
     * Scopes
     * ---------------------------------------------------------
     */

    /**
     * Get specific module
     *
     * @param $query
     * @return mixed
     */
    public function scopeOfType( $query, $type )
    {
        return $query->where( module_name(), $type );
    }
}