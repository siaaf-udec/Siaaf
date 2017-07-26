<?php

namespace App\Container\Unvinteraction\src;

use Illuminate\Database\Eloquent\Model;

class TBL_Estado_Usuario extends Model
{
    public $timestamps = false;
    protected $connection ='unvinteraction';
    protected $table = 'TBL_Estado_Usuario';
    protected $primaryKey = 'PK_Estado_Usuario';
    protected $fillable = ['Estado'];
    public function Usuario(){
        return $this->hasMany(Usuario::class);
    }
}
