<?php

namespace App\Container\Financial\src;


use App\Container\Financial\src\Constants\SchemaConstant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileType extends Model
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
    protected $table = SchemaConstant::FILE_TYPE;

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
        SchemaConstant::FILE_TYPE,
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
    protected $hidden = [SchemaConstant::DELETED_AT];

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
    public function setFileTypesAttribute($string)
    {
        $this->attributes[ file_types() ] = toUpper( $string );
    }

    /*
     * ---------------------------------------------------------
     * Eloquent Relationships
     * ---------------------------------------------------------
     */

    /**
     * Get files relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function files()
    {
        return $this->hasMany( File::class, file_type_fk(), primaryKey() );
    }
}