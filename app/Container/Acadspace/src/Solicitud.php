<?php

namespace App\Container\Acadspace\src;

use App\Container\Users\Src\User;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $connection = 'acadspace';

    protected $table = 'TBL_solicitud';

    protected $primaryKey = 'PK_SOL_id_solicitud';

    protected $fillable = [
        'SOL_guia_practica',
        'SOL_software',
        'SOL_grupo',
        'SOL_cant_estudiantes',
        'SOL_id_docente',
        'SOL_dias',
        'SOL_hora_inicio',
        'SOL_hora_fin',
        'SOL_estado',
        'SOL_fecha_inicio',
        'SOL_fecha_fin',
        'SOL_nucleo_tematico',
        'SOL_id_practica'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'SOL_id_docente');
    }


    public function coment(){
        return $this->hasOne(comentariosSolicitud::class,'FK_COM_id_solicitud');
    }
    //
}
