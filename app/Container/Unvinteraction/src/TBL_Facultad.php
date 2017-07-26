<?php

namespace App\\Container\Unvinteraction\src;

use Illuminate\Database\Eloquent\Model;

class TBL_Facultad extends Model
{
    public function Carrera(){
        return $this->hasMany(Carrera::class);
    }
}
}
