<?php

namespace App\Container\Humtalent\src\Modelos;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function Asistents(){
        return $this->hasMany(Asistent::class);
    }
    //
}
