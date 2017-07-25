<?php

namespace App\Container\Unvinteraction\src;

use Illuminate\Database\Eloquent\Model;

class TBL_Tipo_Usuario extends Model
{
    public $timestamps = false;
    protected $connection ='unvinteraction';
    protected $table = 'TBL_Tipo_Usuario';
    protected $primaryKey = 'PK_Tipo_Usuario';
    protected $fillable = ['Descripcion'];

    public function Usuario(){
        return $this->hasMany(Usuario::class);
    }
}
