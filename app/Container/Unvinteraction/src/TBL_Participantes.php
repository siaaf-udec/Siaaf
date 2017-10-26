<?php

namespace App\Container\Unvinteraction\src;

use Illuminate\Database\Eloquent\Model;

class TBL_Participantes extends Model
{
    //
    public $timestamps = false;
    protected $connection ='unvinteraction';
    protected $table = 'TBL_Participantes';
    protected $primaryKey = 'PK_Participantes';
    protected $fillable = ['FK_TBL_Convenios','FK_TBL_Usuarios'];
    
    /*
    *Función de conexión entre las tablas de TBL_Participantes y TTBL_Convenios
    *por los campo de FK_TBL_Convenios y PK_Convenios
    *para realizar las busquedas complementarias
    */     
    public function convenios_Participantes()
    {
        return $this->belongsto(TBL_Convenios::class, 'FK_TBL_Convenios', 'PK_Convenios');
    }
    
    /*
    *Función de conexión entre la tabla TBL_Evaluacion y la ruta App\Container\Users\Src\User 
    *por los campo de FK_TBL_Usuarios y identity_no
    *para realizar las busquedas complementarias
    */      
    public function usuarios_Participantes()
    {
        return $this->belongsto('App\Container\Users\Src\User', 'FK_TBL_Usuarios', 'identity_no');
    }
}
