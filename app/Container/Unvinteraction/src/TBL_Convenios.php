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
    
    public function convenios_Sedes()
    {
        return $this->belongsto(TBL_Sede::class, 'FK_TBL_Sede', 'PK_Sede');
    }
    public function convenios_Estados()
    {
        return $this->belongsto(TBL_Estado::class, 'FK_TBL_Estado', 'PK_Estado');
    }
    public function convenios_Documentos()
    {
        return $this->hasMany(TBL_Documentacion::class, 'FK_TBL_Convenios', 'PK_Convenios');
    }
    public function convenios_Evaluacion()
    {
        return $this->hasMany(TBL_Evaluacion::class, 'FK_TBL_Convenios', 'PK_Convenios');
    }
    public function convenios_Empresas()
    {
        return $this->hasMany(TBL_Empresas_Participantes::class, 'FK_TBL_Convenios', 'PK_Convenios');
    }
    public function convenios_Participantes()
    {
        return $this->hasMany(TBL_Participantes::class, 'FK_TBL_Convenios', 'PK_Convenios');
    }
}
