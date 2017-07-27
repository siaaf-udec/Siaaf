<?php

namespace App\Container\Users\Src;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $connection = 'developer';
    protected $table = 'regions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'code', 'country_id'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * Get the users for the user.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the users for the user.
     */
    public function cities()
    {
        return $this->hasMany(City::class);
    }

    /**
     * Get the user that owns the country.
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
