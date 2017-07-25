<?php

namespace App\Container\Unvinteraction\src;

use Illuminate\Database\Eloquent\Model;

class TBL_Carrera extends Model
{
    public $timestamps = false;
    protected $connection = 'unvinteraction';
    protected $table = 'tbl_carrera';
    protected $primaryKey = 'PK_Carrera';
    protected $fillable = [
        'PK_Carrera','Carrera','FK_TBL_Facultad',
    ];
    public function Usuario(){
        return $this->hasMany(Usuario::class);
    }
    public function Facultad(){
        return $this->hasMany(Facultad::class);
    }
}

