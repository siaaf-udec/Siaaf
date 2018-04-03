<?php

namespace App\Container\AdminRegist\Src;

use Illuminate\Database\Eloquent\Model;
use App\Container\Users\src\UsersUdec;

class Registros extends Model
{
    protected $connection = 'adminregist';
    protected $table = 'registros';
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_registro','id_novedad'
    ];

    //relationships one to many
    public function registro(){
        return $this->belongsTo(UsersUdec::class,'id_registro');
    }

    //relationships one to many
    public function novedad(){
        return $this->belongsTo(Novedad::class,'id_novedad');
    }






}