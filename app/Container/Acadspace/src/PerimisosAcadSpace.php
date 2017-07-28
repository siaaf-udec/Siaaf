<?php

namespace App\Container\Acadspace\src;

use Illuminate\Database\Eloquent\Model;

class PerimisosAcadSpace extends Model
{
    protected $connection = 'developer';

    protected $table = 'permissions';

    protected $primaryKey = 'id';

    protected $fillable = [

        'name','display_name','description','module_id'
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
