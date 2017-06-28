<?php

namespace App\Container\Humtalent\src\Modelos;

use Illuminate\Database\Eloquent\Model;

class Induction extends Model
{
    public function Personas(){
        return $this->belongsTo(Persona::class);
    }
    //
}
