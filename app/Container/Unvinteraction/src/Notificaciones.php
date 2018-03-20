<?php

namespace App\Container\Unvinteraction\src;

use Illuminate\Database\Eloquent\Model;

class Notificaciones extends Model
{
    public $timestamps = false;
    protected $connection ='unvinteraction';
    protected $table = 'TBL_Notificacion';
    protected $primaryKey = 'PK_NTFC_Notificacion';
    protected $fillable = ['NTFC_Titulo','NTFC_Mensaje','NTFC_Bandera','FK_TBL_Usuarios_Id'];
    
    /*
    *Función de conexión entre las tablas de TBL_Notificacione y Usuario
    *para realizar las busquedas complementarias
    */ 
    public function Usuario(){
        return $this->hasMany(Usuario::class);
    }
}
