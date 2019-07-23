<?php

namespace App\Container\Gesap\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Proyecto extends Model
{
    //modelo en donde se guarda el anteproyecto ya aprobado PROYECTO
    protected $connection = 'gesap';

    protected $table = 'TBL_Proyecto';

    protected $primaryKey = 'PK_Id_Proyecto';

    protected $fillable = [
        'FK_NPRY_IdMctr008',
        'FK_EST_Id',
        'PYT_Fecha_Radicacion',
        'FK_NPRY_Director',
        'NPRY_Pro_Estado',
    ];
    //relacion que muestra el anteproyecto radicado y aprobado anteriormente
    public function relacionAnteproyecto()
    {
         return $this->hasOne(Anteproyecto::class, 'PK_NPRY_IdMctr008', 'FK_NPRY_IdMctr008');
    }
    //relacion que muestra el estado del PROYECTO
    public function relacionEstado()
    {
          return $this->hasone(EstadoAnteproyecto::class, 'PK_EST_Id', 'FK_EST_Id');
    }
     //esta es la relacion que tiene el anteproyecto con su predirecor     
     public function relacionDirectores() 
     {
          return $this->hasOne(Usuarios::class, 'PK_User_Codigo', 'FK_NPRY_Director');
      }
}