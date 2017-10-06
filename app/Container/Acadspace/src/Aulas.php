<?php

namespace App\Container\Acadspace\src;

use DB;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Aulas extends Model
{
    protected $connection = 'acadspace';

    protected $table = 'tbl_aulas';

    protected $primaryKey = 'PK_SAL_id_sala';

    protected $fillable = [
        'SAL_nombre_sala',
        'SAL_nombre_espacio'
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