<?php

namespace App\Container\Humtalent\src;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    /**
     * Conexión de la base de datos usada por el modelo
     *
     * @var string
     */
    protected $connection = 'humtalent';

    /**
     * Tabla utilizada por el modelo.
     *
     * @var string
     */
    protected $table = 'TBL_Notificaciones';

    /**
     * Llave utilizada por el modelo.
     *
     * @var string
     */
    protected $primaryKey = 'PK_NOTIF_Id_Notificacion';

    /**
     * Atributos que son asignables.
     *
     * @var array
     */
    protected $fillable = [

        'NOTIF_Estado_Notificacion', 'NOTIF_Fecha_Inicio', 'NOTIF_Fecha_Fin', 'NOTIF_Descripcion', 'NOTIF_Fecha_Notificacion',

    ];


}
