<?php

namespace App\Container\Administrative\Src;

use Illuminate\Database\Eloquent\Model;

class MacroProceso extends Model
{
    protected $connection = 'adminis';
    protected $table = 'macroproceso';
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre_macro'
    ];

    //relationships one to many
    public function procesomacro(){
        return $this->hasMany(Proceso::class,'id_macro');
    }


}