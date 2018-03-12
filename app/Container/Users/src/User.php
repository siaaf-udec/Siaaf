<?php

namespace App\Container\Users\Src;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;


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
        'name','last_name' ,'email', 'password',
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

}
