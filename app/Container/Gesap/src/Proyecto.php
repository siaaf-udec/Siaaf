<?php

namespace App\Container\Gesap\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Proyecto extends Model
{
    
    protected $connection = 'gesap';

    protected $table = 'TBL_Proyecto';

    protected $primaryKey = 'PK_Id_Proyecto';

    protected $fillable = [
        'FK_NPRY_IdMctr008',
        'FK_EST_Id',
        'PYT_Fecha_Radicacion'
    ];

    public function relacionAnteproyecto()
    {
         return $this->hasOne(Anteproyecto::class, 'PK_NPRY_IdMctr008', 'FK_NPRY_IdMctr008');
    }
    public function relacionEstado()
    {
          return $this->hasone(EstadoAnteproyecto::class, 'PK_EST_Id', 'FK_EST_Id');
    }
}