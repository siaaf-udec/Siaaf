<?php

namespace App\Container\Gesap\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Commits extends Model
{
    //este modelo es de la tabla en donde se guardan las actividades de cada proyecto
    
    protected $connection = 'gesap';

    protected $table = 'TBL_Commits_Anteproyecto';

    protected $primaryKey = 'PK_Id_Commit';

    protected $fillable = [
        'FK_NPRY_IdMctr008'
        ,'FK_MCT_IdMctr008'
        ,'FK_User_Codigo'
        ,'CMMT_Commit'
        ,'FK_CHK_Checklist'
        ,'CMMT_Formato'
        
    ];
    //estado de la actividad
    public function relacionEstado()
    {
        return $this->hasOne(Checklist::class, 'PK_CHK_Checklist', 'FK_CHK_Checklist');
    }
    //nombre de la actividad
     public function relacionActividad()
     {
         return $this->hasOne(Mctr008::class, 'PK_MCT_IdMctr008', 'FK_MCT_IdMctr008');
     }
     //a que anteproyecto pertenece
     public function relacionAnteproyecto()
     {
          return $this->hasOne(Anteproyecto::class, 'PK_NPRY_IdMctr008', 'FK_NPRY_IdMctr008');
     }
     //quien realizo este commit
     public function relacionUsuario()
     {
          return $this->hasOne(Usuarios::class, 'PK_User_Codigo', 'FK_User_Codigo');
     }
     
    
}