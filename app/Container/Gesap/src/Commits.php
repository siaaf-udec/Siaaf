<?php

namespace App\Container\Gesap\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Commits extends Model
{
    
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
    public function relacionEstado()
    {
        return $this->hasOne(Checklist::class, 'PK_CHK_Checklist', 'FK_CHK_Checklist');
    }
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