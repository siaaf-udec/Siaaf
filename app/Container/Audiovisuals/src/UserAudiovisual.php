<?php

namespace App\Container\Audiovisuals\src;

use Illuminate\Database\Eloquent\Model;

class UserAudiovisual extends Model
{
    protected $connection = 'audiovisuals';
    protected $table      = 'TBL_User_Audiovisual';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url', 'audiovisualble_id', 'audiovisualble_type',
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
    public function audiovisualble()
    {
        return $this->morphTo();
    }
}
