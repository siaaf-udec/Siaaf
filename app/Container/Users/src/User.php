<?php

namespace App\Container\Users\Src;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Zizaco\Entrust\Traits\EntrustUserTrait;


class User extends Authenticatable
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

    use Notifiable, SoftDeletes;

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
        'name', 'email', 'password',
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
     * Get the user that owns the city.
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Get the user that owns the country.
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Get the user that owns the region.
     */
    public function region()
    {
        return $this->belongsTo(Region::class);
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

}
