<?php

namespace App\Container\Acadspace\src;

use Illuminate\Database\Eloquent\Model;

class Software extends Model
{
    protected $connection = 'acadspace';

    protected $table = 'tbl_solSoftware';

    protected $primaryKey = 'PK_SOF_id';

    protected $fillable = [
        'SOF_nombre_soft','SOF_version','SOF_licencias'
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
