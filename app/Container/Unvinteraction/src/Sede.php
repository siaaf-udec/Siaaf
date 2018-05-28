<?php

namespace App\Container\Unvinteraction\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sede extends Model
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
    
    protected $table = 'TBL_Sede';
     
    /**
     * llave primaria utilizada por el modelo
     *
     * @var string
     */
    
    protected $primaryKey = 'PK_SEDE_Sede';
      
    /**
     * casilla utilizadas en la tabla y el modelo
     *
     * @var string
     */
    protected $fillable = ['SEDE_Sede'];
    
    /**
     * Atributos que con muteadas
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
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
