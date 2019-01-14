<?php

namespace App\Container\Gesap\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Desarrolladores extends Model
{
    
    protected $connection = 'gesap';

    protected $table = 'tbl_desarrolladores';

    protected $primaryKey = 'PK_Id_desarrollo';

    protected $fillable = [
        'FK_NPRY_IdMctr008'
        ,'FK_User_Codigo'
    ];

    
    public function relacionEstado()
    {
         return $this->hasMany(EstadoAnteproyecto::class, 'PK_EST_id', 'FK_NPRY_Estado');
     }
}