<?php

namespace App\Container\Humtalent\src;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    protected $connection = 'humtalent';

    protected $table = 'TBL_Eventos';

    protected $primaryKey = 'PK_EVNT_IdEvento';

    protected $fillable = [

        'EVNT_Descripcion', 'EVNT_Fecha','EVNT_Hora',
    ];


    public function Asistents(){
        return $this->hasMany(Asistent::class);
    }
    //
}
