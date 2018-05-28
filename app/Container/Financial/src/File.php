<?php

namespace App\Container\Financial\src;


use App\Container\Financial\src\Constants\SchemaConstant;
use App\Container\Users\Src\User;
use App\Transformers\Financial\AuditsTransform;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as Auditor;

class File extends Model implements Auditable
{
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
     * Attributes to include in the Audit.
     *
     * @var array
     */
    protected $auditInclude = [
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
    protected $appends = ['pdf_url', 'semester', 'dropzone_status', 'is_dirty'];


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
        if (Arr::has($data, 'new_values.'.status_fk())) {
            $data['new_values'][ status_fk() ] = StatusRequest::find( $data['new_values'][ status_fk() ] )->{ status_name() };
        }
        if (Arr::has($data, 'old_values.'.status_fk())) {
            $data['old_values'][ status_fk() ] = StatusRequest::find( $data['old_values'][ status_fk() ] )->{ status_name() };
        }
        if (Arr::has($data, 'new_values.'.user_fk())) {
            $data['new_values'][ user_fk() ] = User::find( $data['new_values'][ user_fk() ] )->full_name;
        }
        if (Arr::has($data, 'old_values.'.user_fk())) {
            $data['old_values'][ user_fk() ] = User::find( $data['old_values'][ user_fk() ] )->full_name;
        }
        if (Arr::has($data, 'new_values.'.file_type_fk())) {
            $data['new_values'][ file_type_fk() ] = FileType::find( $data['new_values'][ file_type_fk() ] )->{ file_types() };
        }
        if (Arr::has($data, 'old_values.'.file_type_fk())) {
            $data['old_values'][ file_type_fk() ] = FileType::find( $data['old_values'][ file_type_fk() ] )->{ file_types() };
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
        return ['financial_files'];
    }

    public function getIsDirtyAttribute()
    {
        $audits = $this->audits()->latest()->get();
        $manager = new Manager;
        $resource = new Collection( $audits, new AuditsTransform() );
        return $manager->createData( $resource )->toArray();
    }

    /*
     * ---------------------------------------------------------
     * Accessors and Mutator Attributes
     * ---------------------------------------------------------
     */

    /**
     * Get a pdf url from the storage
     *
     * @return null
     */
    public function getPdfUrlAttribute()
    {
        return isset( $this->{ file_route() } ) ? Storage::disk('financial')->url( $this->{ file_route() } ) : null;
    }

    /**
     * Get current semester
     *
     * @return string
     */
    public function getSemesterAttribute()
    {
        return ( isFirstSemester( $this->{created_at()}->month ) ) ? "IPA {$this->{created_at()}->year}" : "IIPA {$this->{created_at()}->year}";
    }

    /**
     * Get dropzone status to validate if can or not upload files
     *
     * @return bool
     */
    public function getDropzoneStatusAttribute()
    {
        $available = AvailableModules::ofType( status_type_file() )->latest()->first();

        if ( isset( $available->{ available_from() } ) &&
             isset( $available->{ available_until() } ) &&
             isset( $this->{created_at()} ) ) {
            if ( $this->{ created_at() }->lessThan( $available->{ available_from() } ) ) {
                return false;
            } elseif ( $this->{created_at()}->greaterThan( $available->{ available_until() } ) ) {
                return true;
            } elseif ( $this->{ created_at() }->between( $available->{ available_from() }, $available->{ available_until() } ) ) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    /*
     * ---------------------------------------------------------
     * Eloquent Relationships
     * ---------------------------------------------------------
     */

    /**
     * Get status relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function status()
    {
        return $this->hasOne( StatusRequest::class, primaryKey(), status_fk() );
    }

    /**
     * Get user relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo( User::class, user_fk(), 'id' );
    }

    /**
     * Get file type relation
     *
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