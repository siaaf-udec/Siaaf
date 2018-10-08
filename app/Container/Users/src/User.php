<?php

namespace App\Container\Users\Src;

use App\Container\Financial\src\AdditionSubtraction;
use App\Container\Financial\src\Constants\SchemaConstant;
use App\Container\Financial\src\Extension;
use App\Container\Financial\src\File;
use App\Container\Financial\src\IntersemestralStudents;
use App\Container\Acadspace\src\Solicitud;

/**
 * Financial Uses
 */

use App\Container\Financial\src\Program;
use App\Container\Financial\src\Subject;
use App\Container\Financial\src\Validation;
use App\Container\Permissions\Src\Role;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;


use App\Notifications\ResetPassword;

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

    use Notifiable, SoftDeletes, \OwenIt\Auditing\Auditable;

    /**
     * Informamos a la clase EntrustUserTrait que usara restore
     */
    use EntrustUserTrait {
        EntrustUserTrait::restore insteadof SoftDeletes;
    }

    /**
     * Should the timestamps be audited?
     *
     * @var bool
     */
    protected $auditTimestamps = true;

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
     * Attributes to include in the Audit.
     *
     * @var array
     */
    protected $auditInclude = [
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
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['full_name', 'profile_picture'];

    function getImageAttribute()
    {
        $img = isset($this->images[0]->url) ? $this->images[0]->url : '';
        if (strcmp(substr($img, 0, 4), 'data') !== 0 && Storage::disk('developer')->has('avatars', $img)) {
            $img = Storage::disk('developer')->url($img);
        }
        return $img;
    }

    function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    function getRoleAttribute()
    {
        $role_id = $this->roles()->first()->pivot->role_id;
        return Role::find($role_id)->display_name;
    }

    /**
     * The channels the user receives notification broadcasts on.
     *
     * @return string
     */
    function receivesBroadcastNotificationsOn()
    {
        return 'users-notification.' . $this->id;
    }

    function getNumStatusReadNotificationsAttribute()
    {
        return count($this->unreadNotifications);
    }

    /**
     * Get the user that owns the city.
     */
    function city()
    {
        return $this->belongsTo(City::class, 'cities_id');
    }

    /**
     * Get the user that owns the country.
     */
    function country()
    {
        return $this->belongsTo(Country::class, 'countries_id');
    }

    /**
     * Get the user that owns the region.
     */
    function region()
    {
        return $this->belongsTo(Region::class, 'regions_id');
    }

    /*
     * morphMany() Identifica que existe relacion polimorfica
     * Parametros(Entidad de comentarios, Metodo en la entidad de comentario)
     * */
    function images()
    {
        //seoble, likeable, votable....
        return $this->morphMany(Image::class, 'imageble');
    }

    /**
     * Get the UsuarioAudiovisuales record associated with the user.
     */
    function audiovisual()
    {
        return $this->hasOne('App\Container\Audiovisuals\Src\UsuarioAudiovisuales', 'USER_FK_User');
    }

    /**
     * Get the UsuarioInteraction  record associated with the user.
     */
    function unvInteraction()
    {
        return $this->hasOne('App\Container\Unvinteraction\Src\UsuarioInteraction', 'USER_FK_User');
    }

    /*public function acadspace()
    {
        return $this->hasMany(Solicitud::class,user() ,'id');
    }*/

    /**
     * Get the UsuarioEspaciosAcademicos record associated with the user.
     *

     *
     * public function formatosAcadspace()
     * {
     * return $this->hasMany('App\Container\Acadspace\Src\Formatos', 'FK_FAC_id_secretaria');
     * }
     */

    /**
     * Get the UsuarioGesap record associated with the user.
     */
    function gesap()
    {
        return $this->hasOne('App\Container\Gesap\Src\Encargados', 'FK_developer_user_id');
    }

    function getFullNameAttribute()
    {
        return $this->name . ' ' . $this->lastname;
    }

    /**
     * Start Financial Relations
     */

    function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }

    function getProfilePictureAttribute()
    {
        if (isset($this->images[0]->url)) {
            if (filter_var($this->images[0]->url, FILTER_VALIDATE_URL) && file_exists($this->images[0]->url)) {
                return $this->images[0]->url;
            }

            if (Storage::disk('developer')->exists($this->images[0]->url)) {
                return Storage::disk('developer')->url($this->images[0]->url);
            }
        }

        return substr(md5($this->full_name), 16);
    }

    function subjects()
    {
        $table = SchemaConstant::getRelationNameTable(SchemaConstant::SUBJECT_PROGRAM);

        return $this->belongsToMany(Subject::class, $table, program_fk(), subject_fk())
            ->withPivot(program_fk(), teacher_fk());
    }

    function programs()
    {
        $table = SchemaConstant::getRelationNameTable(SchemaConstant::SUBJECT_PROGRAM);

        return $this->belongsToMany(Program::class, $table, subject_fk(), program_fk())
            ->withPivot(subject_fk(), teacher_fk());
    }

    function extensions()
    {
        return $this->hasMany(Extension::class, student_fk(), 'id');
    }

    function validations()
    {
        return $this->hasMany(Validation::class, student_fk(), 'id');
    }

    function intersemestrals()
    {
        return $this->hasMany(IntersemestralStudents::class, student_fk(), 'id');
    }

    function additionSubtraction()
    {
        return $this->hasMany(AdditionSubtraction::class, student_fk(), 'id');
    }

    function filesUploaded()
    {
        return $this->hasMany(File::class, user_fk(), 'id');
    }

    /**
     * End Financial Relations
     */

}
