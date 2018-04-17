<?php
/**
 * Created by PhpStorm.
 * User: danielprado
 * Date: 5/02/18
 * Time: 8:43 PM
 */

namespace App\Container\Financial\src;


use App\Container\Financial\src\Constants\SchemaConstant;
use App\Container\Users\Src\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class File extends Model
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
    protected $table = SchemaConstant::FILES;

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
        SchemaConstant::FILE_NAME,
        SchemaConstant::FILE_ROUTE,
        SchemaConstant::STATUS_FOREIGN_KEY,
        SchemaConstant::USER_FOREIGN_KEY,
        SchemaConstant::FILE_TYPE_FOREIGN_KEY,
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

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['pdf_url', 'semester', 'dropzone_status'];

    /*
     * ---------------------------------------------------------
     * Accessors and Mutator Attributes
     * ---------------------------------------------------------
     */

    public function getPdfUrlAttribute()
    {
        return isset( $this->{ file_route() } ) ? Storage::disk('financial')->url( $this->{ file_route() } ) : null;
    }

    public function getSemesterAttribute()
    {
        return ( isFirstSemester( $this->{created_at()}->month ) ) ? "IPA {$this->{created_at()}->year}" : "IIPA {$this->{created_at()}->year}";
    }

    public function getDropzoneStatusAttribute()
    {
        if ( isFirstSemester( $this->{created_at()}->month )
            && $this->{created_at()}->year == today()->year ) {
            return true;
        } elseif ( !isFirstSemester( $this->{created_at()}->month )
            && $this->{created_at()}->year == today()->year ) {
            return true;
        } else {
            return false;
        }
    }

    /*
     * ---------------------------------------------------------
     * Eloquent Relationships
     * ---------------------------------------------------------
     */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function status()
    {
        return $this->hasOne( StatusRequest::class, primaryKey(), status_fk() );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo( User::class, user_fk(), 'id' );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function file_type()
    {
        return $this->hasOne( FileType::class, primaryKey(), file_type_fk() );
    }

    /**
     * Get all of the extensions's comments.
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}