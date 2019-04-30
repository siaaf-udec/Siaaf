<?php

namespace App\Container\Gesap\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Jurados extends Model
{
    //modelo en donde se guarda los jurados para anteproyecto y su posterior proyecto
    protected $connection = 'gesap';

    protected $table = 'TBL_Jurados';

    protected $primaryKey = 'PK_Id_Jurados';

    protected $fillable = [
        'FK_NPRY_IdMctr008'
        ,'FK_User_Codigo'
        ,'FK_NPRY_Estado'
        ,'FK_NPRY_Estado_Proyecto'
        ,'JR_Comentario'
        ,'JR_Comentario_2'
        ,'JR_Comentario_Proyecto'
        ,'JR_Comentario_Proyecto_2'
    ];

    //relaciona al jurado con su Anteproyecto
    public function relacionAnteproyecto()
    {
         return $this->hasOne(Anteproyecto::class, 'PK_NPRY_IdMctr008', 'FK_NPRY_IdMctr008');
     }
    //relaciona al jurado con su Proyecto
      public function relacionProyecto()
    {
         return $this->hasOne(Proyecto::class, 'FK_NPRY_IdMctr008', 'FK_NPRY_IdMctr008');
     }
     //relaciona la tabla de jurados conla tabla usuarios para tomar sus datos, nombre apellido etc...
     public function relacionUsuarios()
    {
         return $this->hasOne(Usuarios::class, 'PK_User_Codigo', 'FK_User_Codigo');
     }
     //relaciona la tabla jurados con el estado del Anteproyecto (la decision que el tomo)
     public function relacionEstado()
     {
          return $this->hasOne(EstadoAnteproyecto::class, 'PK_EST_Id', 'FK_NPRY_Estado');
      }
     //relaciona la tabla jurados con el estado del proyecto (la decision que el tomo)
      
      public function relacionEstadoJurado()
      {
           return $this->hasOne(EstadoAnteproyecto::class, 'PK_EST_Id', 'FK_NPRY_Estado_Proyecto');
       }
      
}