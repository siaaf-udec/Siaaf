<?php

namespace App\Container\Acadspace\src;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $connection = 'developer';

    protected $table = 'roles';

    protected $primaryKey = 'id';

    protected $fillable = [

        'name','display_name','description',
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