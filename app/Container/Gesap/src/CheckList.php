<?php

namespace App\Container\Gesap\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Checklist extends Model
{
    
    protected $connection = 'gesap';

    protected $table = 'TBL_checklist';

    protected $primaryKey = 'PK_CHK_Checklist';

    protected $fillable = [
        'CHK_Checlist'
        ,'CHK_Checlist_Data'
        
    ];
    
}