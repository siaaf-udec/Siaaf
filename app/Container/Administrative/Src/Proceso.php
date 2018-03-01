<?php

namespace App\Container\Administrative\Src;

use Illuminate\Database\Eloquent\Model;

class Proceso extends Model
{
    protected $connection = 'adminis';
    protected $table = 'proceso';
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre_proceso'
    ];

    //relationships one to many
    public function macroproceso(){
        return $this->belongsTo(MacroProceso::class,'id_macro');
    }

    //relationships one to many
    public function registroingreso(){
        return $this->hasMany(RegistroIngreso::class,'id_proceso');
    }




}