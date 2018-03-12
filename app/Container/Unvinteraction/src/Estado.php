<?php

namespace App\Container\Unvinteraction\src;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    public $timestamps    = false;
    protected $connection ='unvinteraction';
    protected $table      = 'TBL_Estado';
    protected $primaryKey = 'PK_ETAD_Estado';
    protected $fillable   = ['ETAD_Estado'];
   
    /*
    *Función de conexión entre las tablas de TBL_Estado y TBL_Convenios
    *por los campo de FK_TBL_Estado y PK_Estado 
    *para realizar las busquedas complementarias
    */ 
    public function conveniosEstados()
    {
        return $this->hasMany(Convenio::class, 'FK_TBL_Estado_Id', 'PK_ETAD_Estado');
    }
}
