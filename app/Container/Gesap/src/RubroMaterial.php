<?php

namespace App\Container\Gesap\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class RubroMaterial extends Model
{
    
    protected $connection = 'gesap';

    protected $table = 'TBL_RBR_Material';

    protected $primaryKey = 'PK_RBR_Material';

    protected $fillable = [
        'RBR_MTL_Descripcion',
        'RBR_MTL_Justificacion',
        'RBR_MTL_Cantidad',
        'RBR_MTL_Val',
        'RBR_MTL_Solicitado_Udec',
        'RBR_MTL_Contra_Udec',
        'RBR_MTL_Contra_Otro',
        'RBR_MTL_Total',
        'FK_NPRY_IdMctr008'
    ];
    
}