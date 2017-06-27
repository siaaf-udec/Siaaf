<?php

namespace App\Container\Humtalent\src;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $connection = 'humtalent';

    protected $table = 'TBL_Personas';

    protected $primaryKey = 'PK_PRSN_Cedula';

    protected $fillable = [

        'PK_PRSN_Cedula','PRSN_Rol','PRSN_Nombres','PRSN_Apellidos','PRSN_Telefono','PRSN_Correo','PRSN_Direccion',
        'PRSN_Ciudad','PRSN_Eps','PRSN_Fpensiones','PRSN_Area','PRSN_Caja_Compensacion','PRSN_Estado_Persona',
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
    //
}
