<?php

namespace App\Container\Users\Src;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $connection = 'developer';
    protected $table = 'cities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'region_id', 'country_id', 'latitude', 'longitude', 'name'
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
     * Get the user that owns the country.
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Get the user that owns the country.
     */
    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
