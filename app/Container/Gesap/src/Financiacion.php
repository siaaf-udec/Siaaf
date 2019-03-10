<?php

namespace App\Container\Gesap\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Financiacion extends Model
{
    
    protected $connection = 'gesap';

    protected $table = 'TBL_MCT_Financiacion';

    protected $primaryKey = 'PK_Id_Financiacion';

    protected $fillable = [
        'MCT_Financiacion',
        'MCT_Fuente',
        'MCT_Valor_Aportado',
        'FK_NPRY_IdMctr008'
    ];
    
}