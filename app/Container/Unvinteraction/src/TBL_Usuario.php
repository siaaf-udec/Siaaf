<?php

namespace App\Container\Unvinteraction\src;

use Illuminate\Database\Eloquent\Model;

class TBL_Sede extends Model
{
    //
    public $timestamps = false;
    protected $connection ='unvinteraction';
    protected $table = 'TBL_Sede';
    protected $primaryKey = 'PK_Usuario';
    protected $fillable = ['FK_TBL_Users'];
    
    /*
    *Función de conexión entre las tablas de TBL_Sede y TBL_Convenios
    *por los campo de FK_TBL_Sede y PK_Sede
    *para realizar las busquedas complementarias
    */   
    
    
}
