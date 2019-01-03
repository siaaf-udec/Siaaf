<?php

namespace App\Container\Gesap\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Anteproyecto extends Model
{
    
    protected $connection = 'gesap';

    protected $table = 'tbl_anteproyecto';

    protected $primaryKey = 'PK_NPRY_IdMctr008';

    protected $fillable = [
        'NPRY_Titulo'
        ,'NPRY_Keywords'
        ,'NPRY_Duracion'
        ,'NPRY_FechaR'
        ,'NPRY_FechaL'
        ,'FK_NPRY_Estado',
    ];

<<<<<<< HEAD
 
    public function relacionEstado()
=======
    public function relacionUsuariosRadicacion()
>>>>>>> develop
    {
        return $this->hasOne(EstadoAnteproyecto::class, 'PK_EST_id', 'FK_NPRY_Estado');
    }
}