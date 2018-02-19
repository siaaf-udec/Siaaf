<?php

namespace App\Container\Unvinteraction\src;

use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
    //
    public $timestamps = false;
    protected $connection ='unvinteraction';
    protected $table = 'TBL_Sede';
    protected $primaryKey = 'PK_SEDE_Sede';
    protected $fillable = ['SEDE_Sede'];
    
    /*
    *Función de conexión entre las tablas de TBL_Sede y TBL_Convenios
    *por los campo de FK_TBL_Sede y PK_Sede
    *para realizar las busquedas complementarias
    */   
    public function convenioSede()
    {
        return $this->hasMany(Convenio::class,'FK_TBL_Sede_Id', 'PK_SEDE_Sede');
    }
    
}
