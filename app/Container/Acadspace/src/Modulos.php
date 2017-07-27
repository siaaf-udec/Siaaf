<?php

namespace App\Container\Acadspace\src;

use Illuminate\Database\Eloquent\Model;

class Modulos extends Model
{
    protected $connection = 'developer';

    protected $table = 'tbl_modules';

    protected $primaryKey = 'id';

    protected $fillable = [

        'name','description',
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
