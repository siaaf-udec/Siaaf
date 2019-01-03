<?php

namespace App\container\gesap\src;

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
        ,'NPRY_Estado',
    ];

    public function relacionUsuariosRadicacion()
    {
        return $this->hasOne(Radicacion::class, 'PK_NPRY_IdMctr008', 'FK_RDCN_idRadicaccion');
    }
}