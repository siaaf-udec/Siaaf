<?php

namespace App\Container\Gesap\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class RubroEquipos extends Model
{
    //modelo que llena la tabla rubros
    protected $connection = 'gesap';

    protected $table = 'TBL_RBR_Equipos';

    protected $primaryKey = 'PK_RBR_Equipo';

    protected $fillable = [
        'RBR_EQP_Descripcion',
        'RBR_EQP_Lab',
        'RBR_EQP_Actividades',
        'RBR_EQP_Justificacion',
        'RBR_EQP_Cantidad',
        'RBR_EQP_Val',
        'RBR_EQP_Solicitado',
        'RBR_EQP_Contra_Udec',
        'RBR_EQP_Contra_Otro',
        'RBR_EQP_Total',
        'FK_NPRY_IdMctr008'
    ];
    
}