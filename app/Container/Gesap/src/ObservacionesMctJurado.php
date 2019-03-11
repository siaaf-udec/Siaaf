<?php

namespace App\Container\Gesap\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ObservacionesMctJurado extends Model
{
    
    protected $connection = 'gesap';

    protected $table = 'TBL_Observaciones_Mct_Jurado';

    protected $primaryKey = 'PK_Id_Observacion_Jurado';

    protected $fillable = [
        'FK_NPRY_IdMctr008'
        ,'FK_MCT_IdMctr008'
        ,'FK_User_Codigo'
        ,'OBS_Observacion'
        ,'OBS_Formato'
        
        
    ];

     public function relacionActividad()
     {
         return $this->hasOne(Mctr008::class, 'PK_MCT_IdMctr008', 'FK_MCT_IdMctr008');
     }
     public function relacionAnteproyecto()
     {
          return $this->hasOne(Anteproyecto::class, 'PK_NPRY_IdMctr008', 'FK_NPRY_IdMctr008');
     }
     public function relacionUsuario()
     {
          return $this->hasOne(Usuarios::class, 'PK_User_Codigo', 'FK_User_Codigo');
     }
    
    
}