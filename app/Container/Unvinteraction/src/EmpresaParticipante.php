<?php

namespace App\Container\Unvinteraction\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class EmpresaParticipante extends Model
{
    use SoftDeletes;
  
    
/**
     * Conexión de la base de datos usada por el modelo
     *
     * @var string
     */
 
    protected $connection ='unvinteraction';
    
    /**
     * Conexión de la tabla usada por el modelo
     *
     * @var string
     */

    protected $table = 'TBL_Empresa_Participante';
    
    /**
     * llave primaria utilizada por el modelo
     *
     * @var string
     */

    protected $primaryKey = 'PK_EMPT_Empresa_Participante';
   
    /**
     * casilla utilizadas en la tabla y el modelo
     *
     * @var string
     */
    protected $fillable = ['FK_TBL_Convenio_Id','FK_TBL_Empresa_Id'];
     /**
     * Atributos que con muteadas
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    
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
