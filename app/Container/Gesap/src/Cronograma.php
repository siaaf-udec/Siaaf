<?php

namespace App\Container\Gesap\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cronograma extends Model
{
    
    protected $connection = 'gesap';

    protected $table = 'TBL_MCT_Cronograma';

    protected $primaryKey = 'PK_Id_Cronograma';

    protected $fillable = [
        'MCT_CRN_Actividad',
        'MCT_CRN_Semana_inicio',
        'MCT_CRN_Semana_fin',
        'MCT_CRN_Responsable',
        'FK_NPRY_IdMctr008'
    ];
    
}