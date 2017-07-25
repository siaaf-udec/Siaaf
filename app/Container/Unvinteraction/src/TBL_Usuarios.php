<?php

namespace App\Container\Unvinteraction\src;

use Illuminate\Database\Eloquent\Model;

class TBL_Usuarios extends Model
{
    //
    public $timestamps = false;
    protected $connection ='unvinteraction';
    protected $table = 'TBL_Usuarios';
    protected $primaryKey = 'PK_Usuario';
    protected $fillable = ['Usuario','Contraseña','Nombre','Apellido','Correo','Telefono','FK_TBL_Tipo_Usuario','FK_TBL_Carrera','FK_TBL_Documentacion_extra','FK_TBL_Estado_Usuario'];

}
