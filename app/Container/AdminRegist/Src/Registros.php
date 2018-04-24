<?php

namespace App\Container\AdminRegist\Src;

use Illuminate\Database\Eloquent\Model;
use App\Container\Users\src\UsersUdec;

class Registros extends Model
{
    protected $connection = 'adminregist';
    protected $table = 'TBL_Registros';
    protected $primaryKey = 'PK_RE_IdRegistro';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'FK_RE_Registro','FK_RE_Novedad'
    ];

    //relationships one to many de la tabla TBL_Registros con la tabla User_Udec
    public function registro(){
        return $this->belongsTo(UsersUdec::class,'FK_RE_Registro');
    }

    //relationships one to many de la tabla TBL_Registros con la tabla TBL_Novedades
    public function novedad(){
        return $this->belongsTo(Novedad::class,'FK_RE_Novedad');
    }

}