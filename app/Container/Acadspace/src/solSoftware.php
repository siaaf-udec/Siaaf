<?php

namespace App\Container\Acadspace\src;

use Illuminate\Database\Eloquent\Model;

class solSoftware extends Model
{
    protected $connection = 'acadspace';

    protected $table = 'tbl_solSoftware';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre_soft','version','licencias'
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
