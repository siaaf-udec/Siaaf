<?php

namespace App\Container\Gesap\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Desarrolladores extends Model
{   
    //modelo en el cual se asignan los desarrolladores del proyecto
    
    protected $connection = 'gesap';

    protected $table = 'TBL_Desarrolladores';

    protected $primaryKey = 'PK_Id_Desarrollo';

    protected $fillable = [
        'FK_NPRY_IdMctr008'
        ,'FK_User_Codigo'
        ,'FK_IdEstado'
    ];

    //a que poryecto se van ha asignar
    public function relacionAnteproyecto()
    {
         return $this->hasOne(Anteproyecto::class, 'PK_NPRY_IdMctr008', 'FK_NPRY_IdMctr008');
     }
     //el usuario el cual fue asignado
     public function relacionUsuario()
    {
         return $this->hasOne(Usuarios::class, 'PK_User_Codigo', 'FK_User_Codigo');
     }
}