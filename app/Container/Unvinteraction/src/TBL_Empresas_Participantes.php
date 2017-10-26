<?php

namespace App\Container\Unvinteraction\src;

use Illuminate\Database\Eloquent\Model;

class TBL_Empresas_Participantes extends Model
{
    //
    public $timestamps = false;
    protected $connection ='unvinteraction';
    protected $table = 'TBL_Empresas_Participantes';
    protected $primaryKey = 'PK_Empresas_Participantes';
    protected $fillable = ['FK_TBL_Convenios','FK_TBL_Empresa'];
    
    /*
    *Función de conexión entre las tablas de TBL_Empresas_Participantes y TBL_Convenios
    *por los campo de FK_TBL_Convenios y PK_Convenios 
    *para realizar las busquedas complementarias
    */ 
    public function convenios_Empresas()
    {
        return $this->belongsto(TBL_Convenios::class, 'FK_TBL_Convenios', 'PK_Convenios');
    }
    
    /*
    *Función de conexión entre las tablas de TBL_Empresas_Participantes y TBL_Empresa
    *por los campo de FK_TBL_Empresa y PK_Empresa 
    *para realizar las busquedas complementarias
    */ 
     public function patricipantes_Empresas()
    {
        return $this->belongsto(TBL_Empresa::class, 'FK_TBL_Empresa', 'PK_Empresa');
    }
}
