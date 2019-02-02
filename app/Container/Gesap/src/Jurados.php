<?php

namespace App\Container\Gesap\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Jurados extends Model
{
    
    protected $connection = 'gesap';

    protected $table = 'tbl_jurados';

    protected $primaryKey = 'PK_Id_jurados';

    protected $fillable = [
        'FK_NPRY_IdMctr008'
        ,'FK_User_Codigo'
        ,'FK_NPRY_Estado'
        ,'JR_Comentario'
    ];

    
    public function relacionAnteproyecto()
    {
         return $this->hasOne(Anteproyecto::class, 'PK_NPRY_IdMctr008', 'FK_NPRY_IdMctr008');
     }
     public function relacionUsuarios()
    {
         return $this->hasOne(Usuarios::class, 'PK_User_Codigo', 'FK_User_Codigo');
     }
     public function relacionEstado()
     {
          return $this->hasOne(EstadoAnteproyecto::class, 'PK_EST_Id', 'FK_NPRY_Estado');
      }
      
}