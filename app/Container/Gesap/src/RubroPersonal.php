<?php

namespace App\Container\Gesap\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class RubroPersonal extends Model
{
    //modelo que llena la tabla rubros
    protected $connection = 'gesap';

    protected $table = 'TBL_RBR_Personal';

    protected $primaryKey = 'PK_RBR_Personal';

    protected $fillable = [
        'RBR_PER_Nombre',
        'RBR_PER_Funcion',
        'RBR_PER_Tipo',
        'RBR_PER_Dedicacion',
        'RBR_PER_Entidad',
        'RBR_PER_Solicitado_Udec',
        'RBR_PER_Contra_Udec',
        'RBR_PER_Contra_Otro',
        'RBR_PER_Total',
        'FK_NPRY_IdMctr008'
    ];
    
}