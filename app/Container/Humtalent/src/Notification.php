<?php

namespace App\Container\Humtalent\src\Modelos;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public function StatusOfDocuments(){
        return $this->belongsTo(StatusOfDocument::class);
    }
    //
}
