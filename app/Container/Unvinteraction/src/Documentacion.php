<?php

namespace App\Container\Unvinteraction\src;

use Illuminate\Database\Eloquent\Model;

class Documentacion extends Model
{
    /**
     * desactivar opcion de  rellenar casilla update y create date
     *
     * @var string
     */
    public $timestamps    = false;
    
    /**
     * Conexión de la base de datos usada por el modelo
     *
     * @var string
     */
 
    protected $connection = 'unvinteraction';
    
    /**
     * Conexión de la tabla usada por el modelo
     *
     * @var string
     */

    protected $table      = 'TBL_Documentacion';
    
    /**
     * llave primaria utilizada por el modelo
     *
     * @var string
     */

    protected $primaryKey = 'PK_DOCU_Documentacion';
    /**
     * casilla utilizadas en la tabla y el modelo
     *
     * @var string
     */
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
