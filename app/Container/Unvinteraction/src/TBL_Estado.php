<?php

namespace App\Container\Unvinteraction\src;

use Illuminate\Database\Eloquent\Model;

class TBL_Estado extends Model
{
    public $timestamps    = false;
    protected $connection ='unvinteraction';
    protected $table      = 'TBL_Estado';
    protected $primaryKey = 'PK_Estado';
    protected $fillable   = ['Estado'];
   
    /*
    *Función de conexión entre las tablas de TBL_Estado y TBL_Convenios
    *por los campo de FK_TBL_Estado y PK_Estado 
    *para realizar las busquedas complementarias
    */ 
    public function convenios_Estados()
    {
        return $this->hasMany(TBL_Convenios::class, 'FK_TBL_Estado', 'PK_Estado');
    }
}
