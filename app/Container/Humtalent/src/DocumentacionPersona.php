<?php

namespace App\Container\Humtalent\src\Modelos;

use Illuminate\Database\Eloquent\Model;

class DocumentacionPersona extends Model
{
    public function StatusOfDocuments(){
        return $this->hasMany(StatusOfDocument::class);
    }

    //
}
