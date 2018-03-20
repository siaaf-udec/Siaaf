<?php

namespace App\Container\Unvinteraction\src;

use Illuminate\Database\Eloquent\Model;

class Documentacion extends Model
{
    public $timestamps    = false;
    protected $connection = 'unvinteraction';
    protected $table      = 'TBL_Documentacion';
    protected $primaryKey = 'PK_DOCU_Documentacion';
    protected $fillable   = ['DOCU_Nombre','DOCU_Ubicacion','FK_TBL_Convenio_Id'];
    /*
    *Función de conexión entre las tablas de TBL_Convenios y TBL_Documentacion 
    *por los campo de FK_TBL_Convenios y PK_Convenios 
    *para realizar las busquedas complementarias
    */
    public function convenioDocumento()
    {
        return $this->belongsto(Convenio::class, 'FK_TBL_Convenio_Id', 'PK_CVNO_Convenio');
    }
}
