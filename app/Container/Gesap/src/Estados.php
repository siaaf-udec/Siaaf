<?php

namespace App\Container\Gesap\src;

use Illuminate\Database\Eloquent\Model;

class Estados extends Model
{
    protected $connection = 'gesap';

    protected $table = 'TBL_Estados';

    protected $primaryKey = 'PK_IdEstado';

    protected $fillable = [
        'PK_IdEstado',
        'STD_Descripcion',
    ];

    //Relacion del Estado con el Usuario
    public function relacionEstadoUsuario()
    {
        return $this->belongsTo(Usuarios::class,'PK_IdEstado','FK_User_IdEstado');
    }
}
