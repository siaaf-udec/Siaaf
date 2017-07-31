<?php

// MODELO ADMINISTRADOR
namespace App\Container\Audiovisuals\src;

use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    protected $connection = 'audiovisuals';

    protected $table = 'TBL_Administradores';

    protected $primaryKey = 'PK_ADMIN_Cedula';

    protected $fillable = [

        'PK_ADMIN_Cedula', 'ADMIN_Clave', 'FK_ADMIN_Rol', 'ADMIN_Nombres', 'ADMIN_Apellidos', 'ADMIN_Direccion', 'ADMIN_Correo', 'ADMIN_Telefono', 'FK_ADMIN_Estado',
    ];

    public function Asistents()
    {
        return $this->hasMany(Asistent::class);
    }
    public function StatusOfDocuments()
    {
        return $this->hasMany(StatusOfDocument::class);
    }
    public function Inductions()
    {
        return $this->hasMany(Induction::class);
    }
    public function Permissions()
    {
        return $this->hasMany(Permission::class);
    }

}
