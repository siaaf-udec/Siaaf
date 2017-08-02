<?php

namespace App\Container\Audiovisuals\src;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $connection = 'audiovisuals';

    protected $table = 'TBL_Funcionarios';

    protected $primaryKey = 'PK_FUNCIONARIO_Cedula';

    protected $fillable = [

        'PK_FUNCIONARIO_Cedula', 'FUNCIONARIO_Clave', 'FK_FUNCIONARIO_Rol', 'FUNCIONARIO_Nombres', 'FUNCIONARIO_Apellidos', 'FUNCIONARIO_Direccion', 'FUNCIONARIO_Correo', 'FUNCIONARIO_Telefono', 'FK_FUNCIONARIO_Estado', 'FK_FUNCIONARIO_Programa',
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
    //
}
