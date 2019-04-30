<?php

namespace App\Container\Gesap\src;

use Illuminate\Database\Eloquent\Model;

class RolesUsuario extends Model
{
    //modelo que guarda los posibles roles que puede tener un usuario en GESAP (DOCENTE,ESTUDIANTE,COORDINADOR)
    protected $connection = 'gesap';

    protected $table = 'TBL_Rol';

    protected $primaryKey = 'PK_Id_Rol_Usuario';
    
    protected $fillable = ['Rol_Usuario', 'Rol_Descripcion'];

    //Relacion del Rol con el Usuario
    public function relacionRolUsuario()
    {
        return $this->belongsTo(Usuarios::class,'PK_Id_Rol_Usuario','FK_User_IdRol');
    }
}
