<?php

namespace App\Container\Permissions\Src;

use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    protected $connection = 'developer';
    protected $table      = 'audits';
    public $incrementing  = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'user_type', 'event', 'auditable_id', 'auditable_type', 'old_values', 'new_values', 'url', 'user_type', 'url', 'ip_address', 'user_agent', 'tags',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

}
