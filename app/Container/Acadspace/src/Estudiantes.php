<?php

namespace App\Container\Acadspace\src;

use Illuminate\Database\Eloquent\Model;

class Estudiantes extends Model
{
    protected $connection = 'acadspace';

    protected $table = 'TBL_estudiantes';

    protected $primaryKey = 'id_registro';

    protected $fillable = [

        'codigo','nombre',
    ];


    public function Asistents(){
        return $this->hasMany(Asistent::class);
    }
    public function StatusOfDocuments(){
        return $this->hasMany(StatusOfDocument::class);
    }
    public function Inductions(){
        return $this->hasMany(Induction::class);
    }
    public function Permissions(){
        return $this->hasMany(Permission::class);
    }
    //
}
