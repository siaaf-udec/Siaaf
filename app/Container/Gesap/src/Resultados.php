<?php

namespace App\Container\Gesap\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Resultados extends Model
{
    //modelo que llena la tabla resultados del MCT
    protected $connection = 'gesap';

    protected $table = 'TBL_MCT_Resultados';

    protected $primaryKey = 'PK_Id_Resultados';

    protected $fillable = [
        'MCT_Resultado',
        'MCT_Producto_Esperado',
        'MCT_Indicador',
        'MCT_Beneficiario',
        'MCT_Categoria',
        'FK_NPRY_IdMctr008'
    ];
    
}