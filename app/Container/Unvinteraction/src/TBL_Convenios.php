<?php

namespace App\container\Unvinteraction\src;

use Illuminate\Database\Eloquent\Model;

class TBL_Convenios extends Model
{
    //
    public $timestamps    = false;
    protected $connection ='unvinteraction';
    protected $table      = 'TBL_Convenios';
    protected $primaryKey = 'PK_Convenios';
    protected $fillable   =['Nombre','Fecha_Inicio','Fecha_Fin','FK_TBL_Estado','FK_TBL_Sede'];

    /*
    *Función de conexión entre las tablas de TBL_Convenios y TBL_Sedes 
    *por los campo de FK_TBL_Sede y PK_Sede 
    *para realizar las busquedas complementarias
    */
    public function convenios_Sedes()
    {
        return $this->belongsto(TBL_Sede::class, 'FK_TBL_Sede', 'PK_Sede');
    }

    /*
    *Función de conexión entre las tablas de TBL_Convenios y TBL_Estado 
    *por los campo de FK_TBL_Estado y PK_Estado 
    *para realizar las busquedas complementarias
    */
    public function convenios_Estados()
    {
        return $this->belongsto(TBL_Estado::class, 'FK_TBL_Estado', 'PK_Estado');
    }

    /*
    *Función de conexión entre las tablas de TBL_Convenios y TBL_Documentacion 
    *por los campo de FK_TBL_Convenios y PK_Convenios 
    *para realizar las busquedas complementarias
    */
    public function convenios_Documentos()
    {
        return $this->hasMany(TBL_Documentacion::class, 'FK_TBL_Convenios', 'PK_Convenios');
    }

    /*
    *Función de conexión entre las tablas de TBL_Convenios y TBL_Evaluacion 
    *por los campo de FK_TBL_Convenios y PK_Convenios 
    *para realizar las busquedas complementarias
    */
    public function convenios_Evaluacion()
    {
        return $this->hasMany(TBL_Evaluacion::class, 'FK_TBL_Convenios', 'PK_Convenios');
    }
    
    /*
    *Función de conexión entre las tablas de TBL_Convenios y TBL_Empresas_Participante
    *por los campo de FK_TBL_Convenios y PK_Convenios 
    *para realizar las busquedas complementarias
    */    
    public function convenios_Empresas()
    {
        return $this->hasMany(TBL_Empresas_Participantes::class, 'FK_TBL_Convenios', 'PK_Convenios');
    }

    /*
    *Función de conexión entre las tablas de TBL_Convenios y TBL_Participantes
    *por los campo de FK_TBL_Convenios y PK_Convenios 
    *para realizar las busquedas complementarias
    */    
    public function convenios_Participantes()
    {
        return $this->hasMany(TBL_Participantes::class, 'FK_TBL_Convenios', 'PK_Convenios');
    }
}
