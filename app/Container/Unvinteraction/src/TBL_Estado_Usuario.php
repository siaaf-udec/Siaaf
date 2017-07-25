<?php

namespace App\\Container\Unvinteraction\src;

use Illuminate\Database\Eloquent\Model;

class TBL_Estado_Usuario extends Model
{
    public function Usuario(){
        return $this->hasMany(Usuario::class);
    }
}
