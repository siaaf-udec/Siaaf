<?php

namespace App\Container\Gesap\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class RubroTecnologico extends Model
{
    
    protected $connection = 'gesap';

    protected $table = 'TBL_RBR_Tecnologico';

    protected $primaryKey = 'PK_RBR_Tecnologico';

    protected $fillable = [
        'RBR_TEC_Descripcion',
        'RBR_TEC_Justificacion',
        'RBR_TEC_Val',
        'RBR_TEC_Entidad',
        'RBR_TEC_Solicitado_Udec',
        'RBR_TEC_Contra_Udec',
        'RBR_TEC_Contra_Otro',
        'RBR_TEC_Total',
        'FK_NPRY_IdMctr008'
    ];
    
}