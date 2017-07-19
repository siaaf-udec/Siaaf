<?php

// MODELO ADMINISTRADOR
namespace App\Container\Audiovisuals\src;

use Illuminate\Database\Eloquent\Model; 
class Administrador extends Model
{
 	protected $connection = 'audiovisuals';

 	protected $table = 'TBL_Administradores';

 	protected $primaryKey = 'PK_FNS_Cedula';

 	protected $fillable = [

        'PK_FNS_Cedula','FNS_Clave','FK_FNS_Rol','FNS_Nombres','FNS_Apellidos','FNS_Direccion','FNS_Correo','FNS_Telefono','FK_FNS_Estado',
    ];

    public function Asistents(){
        return $this->hasMany(Asistent::class);
    }
    public function StatusOfDocuments(){
        return $this->hasMany(StatusOfDocument::class);
    }
    public function Inductions(){
        return $this->hasMany(Induction::class);
    }
    public function Permissions(){
        return $this->hasMany(Permission::class);
    }


}
