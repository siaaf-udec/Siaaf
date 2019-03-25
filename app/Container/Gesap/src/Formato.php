<?php

namespace App\Container\Gesap\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Formato extends Model
{
    //modelo del mct
    protected $connection = 'gesap';

    protected $table = 'TBL_MCT_Formato';

    protected $primaryKey = 'PK_Id_Formato';

    protected $fillable = [
        'MCT_Formato'
    ];

      
}