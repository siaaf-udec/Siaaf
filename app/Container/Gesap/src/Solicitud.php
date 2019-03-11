<?php

namespace App\Container\Gesap\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Solicitud extends Model
{
    
    protected $connection = 'gesap';

    protected $table = 'TBL_Solicitud';

    protected $primaryKey = 'Pk_Id_Solicitud';

    protected $fillable = [
        'Sol_Solicitud',
        'Sol_Estado',
        'FK_NPRY_IdMctr008',
        'FK_User_Codigo'
    ];
    
    public function relacionUsuario() 
    {
         return $this->hasOne(Usuarios::class, 'PK_User_Codigo', 'FK_User_Codigo');
     }
   public function relacionProyecto()
   {
        return $this->hasOne(Anteproyecto::class, 'PK_NPRY_IdMctr008', 'FK_NPRY_IdMctr008');
    }


}