<?php

namespace App\Container\Humtalent\src;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    /**
     * The database connection used by the model.
     *
     * @var string
     */
    protected $connection = 'humtalent';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'TBL_Notificaciones';

    /**
     * The database key used by the model.
     *
     * @var string
     */
    protected $primaryKey = 'PK_NOTIF_Id_Notificacion';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'NOTIF_Estado_Notificacion', 'NOTIF_Fecha_Inicio', 'NOTIF_Fecha_Fin', 'NOTIF_Descripcion', 'NOTIF_Fecha_Notificacion',

    ];


}
