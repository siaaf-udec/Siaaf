<?php

namespace App\Container\Humtalent\src;

use Illuminate\Database\Eloquent\Model;

class Asistent extends Model
{
    protected $connection = 'humtalent';

    protected $table = 'TBL_Asistentes';


    protected $fillable = [
        'ASIST_Informe', 'FK_TBL_Eventos_IdEvento', 'FK_TBL_Persona_Cedula',
    ];


    public function personas()
    {
        return $this->belongsTo(Persona::class, 'FK_TBL_Persona_Cedula', 'PK_PRSN_Cedula');
    }

    public function events()
    {
        return $this->belongsTo(Event::class, 'FK_TBL_Eventos_IdEvento');
    }
    //
}
