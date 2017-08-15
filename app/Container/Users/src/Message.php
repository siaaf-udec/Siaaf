<?php

namespace App\Container\Users\Src;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $connection = 'developer';
    protected $table = 'messages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'author', 'content'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

}
