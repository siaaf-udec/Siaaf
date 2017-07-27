<?php

namespace App\Container\Users\Src;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $connection = 'developer';
    protected $table = 'countries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'code'
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
     * Get the users for the user.
     */
    public function regions()
    {
        return $this->hasMany(Region::class);
    }
}
