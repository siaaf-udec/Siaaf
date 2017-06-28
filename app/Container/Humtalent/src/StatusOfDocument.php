<?php

namespace App\Container\Humtalent\src;

use Illuminate\Database\Eloquent\Model;

class StatusOfDocument extends Model
{
    public function Personas(){
        return $this->belongsTo(Persona::class);
    }
    public function Notifications(){
        return $this->belongsTo(Notification::class);
    }
    public function DocumentacionPersonas(){
        return $this->belongsTo(DocumentacionPersona::class);
    }
    //
}
