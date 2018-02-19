<?php

namespace App\Container\Unvinteraction\src;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    //
    public $timestamps = false;
    protected $connection ='unvinteraction';
    protected $table = 'TBL_Empresa';
    protected $primaryKey = 'PK_EMPS_Empresa';
    protected $fillable = ['EMPS_Nombre_Empresa','EMPS_Razon_Social','EMPS_Telefono','EMPS_Direccion'];
    
    /*
    *Función de conexión entre las tablas de TBL_Empresa y TBL_Empresas_Participantes
    *por los campo de FK_TBL_Empres y PK_Empresa 
    *para realizar las busquedas complementarias
    */ 
    public function participanteEmpresas()
    {
        return $this->hasMany(EmpresaParticipante::class, 'FK_TBL_Empresa_Id', 'PK_EMPS_Empresa');
    }
}
