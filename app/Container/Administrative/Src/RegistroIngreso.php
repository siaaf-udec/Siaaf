<?php

namespace App\Container\Administrative\Src;

use Illuminate\Database\Eloquent\Model;

class RegistroIngreso extends Model
{
    protected $connection = 'adminis';
    protected $table = 'registro_ingreso';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    //relationships one to many
    public function registro(){
        return $this->belongsTo(Registro::class,'id_registro');
    }

    //relationships one to many
    public function proceso(){
        return $this->belongsTo(Proceso::class,'id_proceso');
    }


}