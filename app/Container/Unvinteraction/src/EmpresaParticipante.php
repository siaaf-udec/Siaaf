<?php

namespace App\Container\Unvinteraction\src;

use Illuminate\Database\Eloquent\Model;

class EmpresaParticipante extends Model
{
    //
    public $timestamps = false;
    protected $connection ='unvinteraction';
    protected $table = 'TBL_Empresa_Participante';
    protected $primaryKey = 'PK_EMPT_Empresa_Participante';
    protected $fillable = ['FK_TBL_Convenio_Id','FK_TBL_Empresa_Id'];
    
    /*
    *Función de conexión entre las tablas de TBL_Empresas_Participantes y TBL_Convenios
    *por los campo de FK_TBL_Convenios y PK_Convenios 
    *para realizar las busquedas complementarias
    */ 
    public function conveniosEmpresas()
    {
        return $this->belongsto(Convenio::class, 'FK_TBL_Convenio_Id', 'PK_CVNO_Convenio');
    }
    
    /*
    *Función de conexión entre las tablas de TBL_Empresas_Participantes y TBL_Empresa
    *por los campo de FK_TBL_Empresa y PK_Empresa 
    *para realizar las busquedas complementarias
    */ 
     public function patricipantesEmpresas()
    {
        return $this->belongsto(Empresa::class, 'FK_TBL_Empresa_Id', 'PK_EMPS_Empresa');
    }
}
