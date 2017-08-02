<?php

namespace App\Container\Carpark\src;

use Illuminate\Database\Eloquent\Model;

class ModUserCK extends Model
{
    protected $connection = 'carpark';

    protected $table = 'TBL_User_Parks';

    protected $primaryKey = 'PK_CK_Cedula';

    protected $fillable = [

      'PK_CK_Cedula','CK_Nombres','CK_Apellidos','CK_Telefono','CK_Correo','CK_Direccion',
      'CK_Ciudad','CK_Codigo','CK_IdPrograma',
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
