<?php

namespace App\Container\Unvinteraction\src;

use Illuminate\Database\Eloquent\Model;

class TBL_Notificaciones extends Model
{
    public $timestamps = false;
    protected $connection ='unvinteraction';
    protected $table = 'TBL_Notificaciones';
    protected $primaryKey = 'PK_Notificacion';
    protected $fillable = ['Titulo','Mensaje','Bandera','FK_TBL_Usuarios'];
    public function Usuario(){
        return $this->hasMany(Usuario::class);
    }
}
