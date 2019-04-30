<?php

namespace App\Container\Gesap\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ObservacionesMct extends Model
{
    //modelo en donde se guardan los comentarios hechos por docente director y estuudiante
    protected $connection = 'gesap';

    protected $table = 'TBL_Observaciones_Mct';

    protected $primaryKey = 'PK_Id_Observacion';

    protected $fillable = [
        'FK_NPRY_IdMctr008'
        ,'FK_MCT_IdMctr008'
        ,'FK_User_Codigo'
        ,'OBS_Observacion'
        ,'OBS_Limit'
        
    ];
    //relacionq ue muestra la actividad a la que fue agregada un comentario
     public function relacionActividad()
     {
         return $this->hasOne(Mctr008::class, 'PK_MCT_IdMctr008', 'FK_MCT_IdMctr008');
     }
     //relacion a la cual apunta el Anteproyectoa la cual fue hecha la observacion
     public function relacionAnteproyecto()
     {
          return $this->hasOne(Anteproyecto::class, 'PK_NPRY_IdMctr008', 'FK_NPRY_IdMctr008');
     }
     //relacion que muestra los datos del usuario que realizo la observacion
     public function relacionUsuario()
     {
          return $this->hasOne(Usuarios::class, 'PK_User_Codigo', 'FK_User_Codigo');
     }
     
    
}