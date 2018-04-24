<?php

namespace App\Container\Unvinteraction\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Estado extends Model
{
     use SoftDeletes;
    
    
    /**
     * Conexión de la base de datos usada por el modelo
     *
     * @var string
     */
 
    protected $connection ='unvinteraction';
    
    /**
     * Conexión de la tabla usada por el modelo
     *
     * @var string
     */

    protected $table      = 'TBL_Estado';
   	/**
     * llave primaria utilizada por el modelo
     *
     * @var string
     */

    protected $primaryKey = 'PK_ETAD_Estado';
   
    /**
     * casilla utilizadas en la tabla y el modelo
     *
     * @var string
     */
    protected $fillable   = ['ETAD_Estado'];
    
   /**
     * Atributos que con muteadas
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    /*
    *Función de conexión entre las tablas de TBL_Estado y TBL_Convenios
    *por los campo de FK_TBL_Estado y PK_Estado 
    *para realizar las busquedas complementarias
    */ 
    public function conveniosEstados()
    {
        return $this->hasMany(Convenio::class, 'FK_TBL_Estado_Id', 'PK_ETAD_Estado');
    }
}
