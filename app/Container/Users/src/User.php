<?php

namespace App\Container\Users\Src;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * Financial Uses
 */

use App\Container\Financial\src\Constants\SchemaConstant;
use App\Container\Financial\src\Extension;
use App\Container\Financial\src\Program;
use App\Container\Financial\src\Subject;
use App\Container\Permissions\Src\Role;
use App\Container\Financial\src\AdditionSubtraction;
use App\Container\Financial\src\File;
use App\Container\Financial\src\IntersemestralStudents;
use App\Container\Financial\src\Validation;
use Illuminate\Support\Facades\Storage;


class User extends Authenticatable implements AuditableContract
{
    /**
     * The database connection used by the model.
     *
     * @var string
     */
    protected $connection = 'developer';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    use Notifiable, SoftDeletes, Auditable;

    /**
     * Informamos a la clase EntrustUserTrait que usara restore
     */
    use EntrustUserTrait {
        EntrustUserTrait::restore insteadof SoftDeletes;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'lastname',
        'birthday',
        'identity_type',
        'identity_no',
        'identity_expe_place',
        'identity_expe_date',
        'address',
        'sexo',
        'phone',
        'email',
        'state',
        'password',
        'cities_id',
        'countries_id',
        'regions_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['full_name', 'profile_picture'];

    /**
     * The channels the user receives notification broadcasts on.
     *
     * @return string
     */
    public function receivesBroadcastNotificationsOn()
    {
        return 'users-notification.'.$this->id;
    }

    public function getNumStatusReadNotificationsAttribute()
    {
        return count($this->unreadNotifications );
    }

    /**
     * Get the user that owns the city.
     */
    public function city()
    {
        return $this->belongsTo(City::class, 'cities_id');
    }

    /**
     * Get the user that owns the country.
     */
    public function country()
    {
        return $this->belongsTo(Country::class, 'countries_id');
    }

    /**
     * Get the user that owns the region.
     */
    public function region()
    {
        return $this->belongsTo(Region::class, 'regions_id');
    }

    /*
     * morphMany() Identifica que existe relacion polimorfica
     * Parametros(Entidad de comentarios, Metodo en la entidad de comentario)
     * */
    public function images()
    {
        //seoble, likeable, votable....
        return $this->morphMany(Image::class, 'imageble');
    }

    /**
     * Get the UsuarioAudiovisuales record associated with the user.
     */
    public function audiovisual()
    {
        return $this->hasOne('App\Container\Audiovisuals\Src\UsuarioAudiovisuales', 'USER_FK_User');
    }

    /**
     * Get the UsuarioInteraction  record associated with the user.
     */
    public function unvInteraction()
    {
        return $this->hasOne('App\Container\Unvinteraction\Src\UsuarioInteraction', 'USER_FK_User');
    }

    /**
     * Get the UsuarioEspaciosAcademicos record associated with the user.
     *
    public function acadspace()
    {
        return $this->hasMany('App\Container\Acadspace\Src\Solicitud', 'SOL_id_docente');
    }

    public function formatosAcadspace()
    {
        return $this->hasMany('App\Container\Acadspace\Src\Formatos', 'FK_FAC_id_secretaria');
    }
    */

    /**
     * Get the UsuarioGesap record associated with the user.
     */
    public function gesap()
    {
        return $this->hasOne('App\Container\Gesap\Src\Encargados', 'FK_developer_user_id');
    }

    public function getFullNameAttribute()
    {
        return $this->name . ' ' . $this->lastname;
    }

    /**
     * Start Financial Relations
     */

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }

    public function getProfilePictureAttribute()
    {
        if ( isset( $this->images[0]->url ) ) {
            if ( filter_var($this->images[0]->url, FILTER_VALIDATE_URL) && file_exists( $this->images[0]->url ) ) {
                return $this->images[0]->url;
            }

            if ( Storage::disk('developer')->exists( $this->images[0]->url ) ) {
                return Storage::disk('developer')->url($this->images[0]->url);
            }
        }

        return substr( md5($this->full_name), 16 );
    }

    public function subjects()
    {
        $table = SchemaConstant::getRelationNameTable( SchemaConstant::SUBJECT_PROGRAM );

        return $this->belongsToMany(Subject::class, $table, program_fk(), subject_fk())
            ->withPivot(program_fk(), teacher_fk());
    }

    public function programs()
    {
        $table = SchemaConstant::getRelationNameTable( SchemaConstant::SUBJECT_PROGRAM );

        return $this->belongsToMany(Program::class, $table, subject_fk(), program_fk())
            ->withPivot(subject_fk(), teacher_fk());
    }

    public function extensions()
    {
        return $this->hasMany(Extension::class, student_fk(), 'id');
    }

    public function validations()
    {
        return $this->hasMany(Validation::class, student_fk(), 'id');
    }

    public function intersemestrals()
    {
        return $this->hasMany(IntersemestralStudents::class, student_fk(), 'id');
    }

    public function additionSubtraction()
    {
        return $this->hasMany( AdditionSubtraction::class, student_fk(), 'id' );
    }

    public function filesUploaded()
    {
        return $this->hasMany(File::class, user_fk(), 'id');
    }

    /**
     * End Financial Relations
     */

}
