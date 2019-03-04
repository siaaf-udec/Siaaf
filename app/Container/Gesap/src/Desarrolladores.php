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
        ,'Fk_IdEstado'
    ];

    
    public function relacionAnteproyecto()
    {
         return $this->hasOne(Anteproyecto::class, 'PK_NPRY_IdMctr008', 'FK_NPRY_IdMctr008');
     }
}