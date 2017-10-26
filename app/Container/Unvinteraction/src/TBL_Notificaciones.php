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
    
    /*
    *Función de conexión entre las tablas de TBL_Notificacione y Usuario
    *para realizar las busquedas complementarias
    */ 
    public function Usuario(){
        return $this->hasMany(Usuario::class);
    }
}
