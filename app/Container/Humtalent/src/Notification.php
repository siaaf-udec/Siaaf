<?php

namespace App\Container\Humtalent\src;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $connection = 'humtalent';

    protected $table = 'TBL_Notificaciones';

    protected $primaryKey = 'PK_NOTIF_Id_Notificacion';

    protected $fillable = [

        'NOTIF_Estado_Notificacion','NOTIF_Fecha_Inicio','NOTIF_Fecha_Fin','NOTIF_Descripcion','NOTIF_Fecha_Notificacion',

    ];


}
