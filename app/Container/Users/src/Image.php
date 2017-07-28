<?php

namespace App\Container\Users\Src;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $connection = 'developer';
    protected $table = 'images';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url', 'imageble_id', 'imageble_type'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /*
    * morphTo() Transformarce a..
    */
    //seoble, likeable, votable....
    public function imageble()
    {
        return $this->morphTo();
    }
}
