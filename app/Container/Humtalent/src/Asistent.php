<?php

namespace App\Container\Humtalent\src\Modelos;

use Illuminate\Database\Eloquent\Model;

class Asistent extends Model
{
    public function Personas(){
        return $this->belongsTo(Persona::class);
    }
    public function Events(){
        return $this->belongsTo(Event::class);
    }
    //
}
