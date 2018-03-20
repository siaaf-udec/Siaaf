<?php

namespace App\Container\Unvinteraction\src;

use Illuminate\Database\Eloquent\Model;

class Participantes extends Model
{
    //
    public $timestamps = false;
    protected $connection ='unvinteraction';
    protected $table = 'TBL_Participantes';
    protected $primaryKey = 'PK_PTPT_Participantes';
    protected $fillable = ['FK_TBL_Convenio_Id','FK_TBL_Usuarios_Id'];
    
    /*
    *Función de conexión entre las tablas de TBL_Participantes y TTBL_Convenio
    *por los campo de FK_TBL_Convenios y PK_Convenios
    *para realizar las busquedas complementarias
    */     
    public function conveniosParticipante()
    {
        return $this->belongsto(Convenio::class, 'FK_TBL_Convenio_Id', 'PK_CVNO_Convenio');
    }
    
    /*
    *Función de conexión entre la tabla TBL_Participantes y TBL_Usiario
    *por los campo de FK_TBL_Usuarios y identity_no
    *para realizar las busquedas complementarias
    */      
    public function usuariosParticipantes()
    {
        return $this->belongsto( Usuario::class, 'FK_TBL_Usuarios_Id', 'PK_USER_Usuario');
    }
}
