<?php

namespace App\Container\Permissions\Src;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $connection = 'developer';
    protected $table = 'TBL_Modules';
    public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * Get the permissions for the permission.
     */
    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }
}
