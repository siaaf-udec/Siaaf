<?php

namespace App\Container\CalidadPcs\src;

use Illuminate\Database\Eloquent\Model;
//use App\Container\Users\src\UsersUdec;

class Proyectos extends Model
{
    protected $connection = 'calidadpcs';

    protected $table = 'TBL_Calidadpcs_proyectos'; 

    protected $primaryKey = 'PK_CP_Id_Proyecto';

    protected $fillable = [
        'PK_CP_Id_Proyecto'
        , 'CP_Nombre_Proyecto'
        , 'CP_Fecha_Inicio'
        , 'CP_Fecha_Final'
        , 'FK_CP_Id_Usuario',
    ];
    
}
